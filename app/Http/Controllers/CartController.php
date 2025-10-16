<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
// use Illuminate\Container\Attributes\Log;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {


        $items = Cart::instance('cart')->content();

        return view('cart', [
            'items' => $items
        ]);
    }




    public function add_to_cart(Request $request)
    {
        if ($request->size == null) {
            return response()->json(['error' => 'Please select a size'], 400);
        }

        try {
            $product = Product::find($request->id);
            $cart = Cart::instance('cart')->content();

            // ✅ Check if same product with same size exists in the cart
            $existingItem = $cart->where('id', $request->id)
                ->where('options.size', $request->size)
                ->first();

            if ($existingItem) {
                // ✅ If exists, update quantity
                Cart::instance('cart')->update($existingItem->rowId, $existingItem->qty + $request->quantity);
            } else {
                // ✅ If not exists, add as a new item
                Cart::instance('cart')->add([
                    'id' => $request->id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'qty'   => $request->quantity,
                    'options' => ['size' => $request->size] // ✅ Keep size in options
                ])->associate('App\Models\Product');
            }

            return response()->json([
                'message' => 'Product added to cart',
                'cart_count' => Cart::instance('cart')->count() // ✅ Update cart count
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function increase_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);

        $qty = $product->qty + 1;

        Cart::instance('cart')->update($rowId, $qty);

        return redirect()->back();
    }

    public function decrease_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);

        $qty = $product->qty - 1;

        Cart::instance('cart')->update($rowId, $qty);

        return redirect()->back();
    }


    public function cart_remove($rowId)
    {
        Cart::instance('cart')->remove($rowId);

        return redirect()->back()->with('success', 'Product removed from cart');
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();

        return redirect()->back()->with('success', 'Cart cleared');
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->input('coupon_code');
        Log::info('Coupon Code Input:', ['coupon_code' => $coupon_code]);

        if (!$coupon_code) {
            return redirect()->back()->with('error', 'Please enter a coupon code.');
        }

        // Convert cart subtotal to a numeric value
        $cartSubtotal = (float) str_replace(',', '', Cart::instance('cart')->subtotal());

        $coupon = Coupon::where('code', $coupon_code)
            ->where('expiry_date', '>=', Carbon::today())
            ->where('cart_value', '<=', $cartSubtotal)
            ->first();

        Log::info('Coupon Query Result:', ['coupon' => $coupon]);

        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid or expired coupon code.');
        }

        Log::info('Valid Coupon Found:', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);

        Session::put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);

        Log::info('Session Data After Coupon Applied:', Session::get('coupon'));

        $this->calculate_discount();

        return redirect()->back()->with('success', 'Coupon code applied successfully.');
    }

    public function calculate_discount()
    {
        if (!Session::has('coupon')) {
            Log::error('No Coupon Found in Session');
            return;
        }

        $coupon = Session::get('coupon');
        $discount = 0;

        // Convert cart subtotal to a numeric value
        $cartSubtotal = (float) str_replace(',', '', Cart::instance('cart')->subtotal());

        // Calculate discount based on coupon type
        if ($coupon['type'] == 'fixed') {
            $discount = $coupon['value'];
        } else { // Percentage discount
            $discount = ($cartSubtotal * $coupon['value']) / 100;
        }

        // Calculate values after discount
        $subTotalAfterDiscount = $cartSubtotal - $discount;
        $taxAfterDiscount = ($subTotalAfterDiscount * config('cart.tax')) / 100;
        $totalAfterDiscount = $subTotalAfterDiscount + $taxAfterDiscount;

        // Log calculated values
        Log::info('Discount Calculation:', [
            'discount' => $discount,
            'subtotal_after_discount' => $subTotalAfterDiscount,
            'tax_after_discount' => $taxAfterDiscount,
            'total_after_discount' => $totalAfterDiscount
        ]);

        // Store discount data in session
        Session::put('discounts', [
            'discount' => number_format(floatval($discount), 2, '.', ''),
            'subtotal' => number_format(floatval($subTotalAfterDiscount), 2, '.', ''),
            'tax' => number_format(floatval($taxAfterDiscount), 2, '.', ''),
            'total' => number_format(floatval($totalAfterDiscount), 2, '.', '')
        ]);

        // Log session data after saving discount details
        Log::info('Session Data After Discount Calculation:', Session::get('discounts'));
    }

    public function remove_coupon_code()
    {
        Session::forget('discounts');
        Session::forget('coupon');
        return redirect()->back()->with('success', 'Coupon code removed successfully.');
    }


    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $Address = Address::where('user_id', Auth::user()->id)->where('is_default', 1)->first();

        return view('checkout', [
            'Address' => $Address
        ]);
    }

    public function place_an_order(Request $request)
    {

        try {
            if ($request->mode == null) {
                return redirect()->back()->with('error', 'Please select payment mode');
            } else {
                $user_id = Auth::user()->id;

                // Fetch the default address for the user
                $Address = Address::where('user_id', $user_id)->where('is_default', 1)->first();

                // If no default address is found, validate and create a new address
                if (!$Address) {
                    $request->validate([
                        'name' => 'required|string|max:100',
                        'phone' => 'required|numeric|digits:11',
                        'zip' => 'required|numeric|digits:4',
                        'state' => 'required|string|max:255',
                        'city' => 'required|string|max:255',
                        'address' => 'required',
                        'locality' => 'required',
                        'landmark' => 'required',
                    ]);

                    if ($request->mode == null) {
                        return redirect()->back()->with('error', 'Please select payment Method');
                    }
                    // Create a new address
                    $Address = new Address();
                    $Address->user_id = $user_id;
                    $Address->name = $request->name;
                    $Address->phone = $request->phone;
                    $Address->zip = $request->zip;
                    $Address->state = $request->state;
                    $Address->city = $request->city;
                    $Address->address = $request->address;
                    $Address->locality = $request->locality;
                    $Address->landmark = $request->landmark;
                    $Address->country = 'Bangladesh';
                    $Address->is_default = true;
                    $Address->save();
                }

                // Set the amounts for checkout
                $this->setAmountForCheckout();

                // Prepare and format the order data
                $order = new Order();
                $order->user_id = $user_id;
                $order->subtotal = $this->formatAmount(Session::get('checkout')['subtotal']);
                $order->discount = $this->formatAmount(Session::get('checkout')['discount']);
                $order->tex = $this->formatAmount(Session::get('checkout')['tax']);
                $order->total = $this->formatAmount(Session::get('checkout')['total']);
                $order->name = $Address->name;
                $order->phone = $Address->phone;
                $order->locality = $Address->locality;
                $order->address = $Address->address;
                $order->city = $Address->city;
                $order->state = $Address->state;
                $order->country = $Address->country;
                $order->landmark = $Address->landmark;
                $order->zip = $Address->zip;
                $order->save();
                $order->load('orderItems');
                // Save the order items
                foreach (Cart::instance('cart')->content() as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item->id;
                    $orderItem->quantity = $item->qty;
                    $orderItem->price = $item->price;
                    $orderItem->size = $item->options['size'];
                    $orderItem->save();
                }

                // Handle payment modes
                if ($request->mode == "card") {
                    // Handle card payment (if implemented)
                } else if ($request->mode == "paypal") {
                    // Handle PayPal payment (if implemented)
                } else if ($request->mode == "cod") {
                    // Handle cash on delivery (COD)
                    $transaction = new Transaction();
                    $transaction->user_id = $user_id;
                    $transaction->order_id = $order->id;
                    $transaction->mode = $request->mode;
                    $transaction->status = 'pending';
                    $transaction->save();
                } else {
                    return redirect()->back()->with('error', 'Payment Method not found!');
                }

                // Clear the cart and session data
                Cart::instance('cart')->destroy();
                Session::forget('checkout');
                Session::forget('coupon');
                Session::forget('discounts');
                Session::put('order_id', $order->id);

                // Redirect to the confirmation page
                return redirect()->route('cart.order.confirmation')
                    ->with('success', 'Order placed successfully.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    // Helper method to format amounts correctly
    private function formatAmount($amount)
    {
        // Remove commas and format to a valid float number
        return floatval(str_replace(',', '', $amount));
    }

    public function setAmountForCheckout()
    {
        if (!Cart::instance('cart')->count() > 0) {
            Session::forget('checkout');
            return;
        }

        if (Session::has('coupon')) {
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total']
            ]);
        } else {
            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total()
            ]);
        }
    }


    public function order_confirmation()
    {
        if (!Session::has('order_id')) {
            abort(404);
        } else {
            $order = Order::find(Session::get('order_id'));
            return view('order-confirmation', compact('order'));
        }
    }
}
