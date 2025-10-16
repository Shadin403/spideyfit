<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the 10 most recent orders
        $orders = Order::orderBy('created_at', 'DESC')->take(10)->get();

        // Fetch monthly data for the current year
        $monthlyDatas = DB::table('month_names as M')
            ->leftJoin(DB::raw("(SELECT
                MONTH(created_at) as MonthNo,
                DATE_FORMAT(created_at, '%b') as MonthName,
                COALESCE(SUM(total), 0) as TotalAmount,
                COALESCE(SUM(CASE WHEN status = 'ordered' THEN total ELSE 0 END), 0) as TotalOrderedAmount,
                COALESCE(SUM(CASE WHEN status = 'shipped' THEN total ELSE 0 END), 0) as TotalShippedAmount,
                COALESCE(SUM(CASE WHEN status = 'delivered' THEN total ELSE 0 END), 0) as TotalDeliveredAmount,
                COALESCE(SUM(CASE WHEN status = 'canceled' THEN total ELSE 0 END), 0) as TotalCanceledAmount
            FROM orders
            WHERE YEAR(created_at) = YEAR(NOW())
            GROUP BY MONTH(created_at), DATE_FORMAT(created_at, '%b')
            ORDER BY MONTH(created_at)
            ) AS D"), 'D.MonthNo', '=', 'M.id')
            ->select(
                'M.id as MonthNo',
                'M.name as MonthName',
                DB::raw('IFNULL(D.TotalAmount, 0) as TotalAmount'),
                DB::raw('IFNULL(D.TotalOrderedAmount, 0) as TotalOrderedAmount'),
                DB::raw('IFNULL(D.TotalShippedAmount, 0) as TotalShippedAmount'),
                DB::raw('IFNULL(D.TotalDeliveredAmount, 0) as TotalDeliveredAmount'),
                DB::raw('IFNULL(D.TotalCanceledAmount, 0) as TotalCanceledAmount')
            )
            ->orderBy('M.id')
            ->get();

        // Prepare data for the view
        $AmountM = json_encode($monthlyDatas->pluck('TotalAmount')->toArray());
        $OrderedAmountM = json_encode($monthlyDatas->pluck('TotalOrderedAmount')->toArray());
        $ShippedAmountM = json_encode($monthlyDatas->pluck('TotalShippedAmount')->toArray());
        $DeliveredAmountM = json_encode($monthlyDatas->pluck('TotalDeliveredAmount')->toArray());
        $CanceledAmountM = json_encode($monthlyDatas->pluck('TotalCanceledAmount')->toArray());

        $TotalAmount = $monthlyDatas->sum('TotalAmount');
        $TotalOrderedAmount = $monthlyDatas->sum('TotalOrderedAmount');
        $TotalShippedAmount = $monthlyDatas->sum('TotalShippedAmount');
        $TotalDeliveredAmount = $monthlyDatas->sum('TotalDeliveredAmount');
        $TotalCanceledAmount = $monthlyDatas->sum('TotalCanceledAmount');

        return view('admin.index', [
            'orders' => $orders,
            'AmountM' => $AmountM,
            'OrderedAmountM' => $OrderedAmountM,
            'ShippedAmountM' => $ShippedAmountM,
            'DeliveredAmountM' => $DeliveredAmountM,
            'CanceledAmountM' => $CanceledAmountM,
            'TotalAmount' => $TotalAmount,
            'TotalOrderedAmount' => $TotalOrderedAmount,
            'TotalShippedAmount' => $TotalShippedAmount,
            'TotalDeliveredAmount' => $TotalDeliveredAmount,
            'TotalCanceledAmount' => $TotalCanceledAmount
        ]);
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.orders.orders', ['orders' => $orders]);
    }

    public function order_details($id)
    {

        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $id)->orderBy('id')->paginate(5);
        $transactions = Transaction::where('order_id', $id)->first();
        return view(
            'admin.orders.order-details',
            [
                'order' => $order,
                'orderItems' => $orderItems,
                'transactions' => $transactions
            ]
        );
    }

    public function update_order_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        // Ensure 'status' is set correctly
        $order->status = $request->order_status; // Change $request->status to $request->order_status

        if ('delivered' == $request->order_status) {
            $order->delivered_date = now();
        } else if ('canceled' == $request->order_status) {
            $order->canceled_date = now();
        } else if ('returned' == $request->order_status) {
            $order->returned_date = now();
        }
        $order->save();

        if ($request->order_status == 'delivered') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            if ($transaction) {
                $transaction->status = 'approved';
                $transaction->save();
            }
        }
        if ($request->order_status == 'canceled') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            if ($transaction) {
                $transaction->status = 'declined';
                $transaction->save();
            }
        }
        if ($request->order_status == 'ordered') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            if ($transaction) {
                $transaction->status = 'pending';
                $transaction->save();
            }
        }

        if ($request->order_status == 'returned') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            if ($transaction) {
                $transaction->status = 'declined';
                $transaction->save();
            }

            OrderItem::where('order_id', $order->id)
                ->where('return_status', 0)
                ->update(['return_status' => 1]);
        }


        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully');
    }


    public function contact()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.contact.contact', ['contacts' => $contacts]);
    }

    public function contact_show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.contact.contact-show', ['contact' => $contact]);
    }

    public function destroy_contact($id)
    {

        $contact = Contact::findOrFail($id);
        $contact->delete();
        return Redirect::route('admin.contact')->with('success', 'Contact with id ' . $id . ' deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // This will check if the query is empty
        if (empty(trim($query))) {
            return response()->json([]);
        }

        // this is for case-insensitive search
        $products = Product::select('id', 'name', 'image', 'slug')
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->limit(8)
            ->get();

        return response()->json($products);
    }
}
