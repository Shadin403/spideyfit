<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index');
    }


    public function orders()
    {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.orders', ['orders' => $order]);
    }

    public function order_details($order_id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        $transactions = Transaction::where('order_id', $order_id)->first();
        return view('user.order-details', ['order' => $order, 'transactions' => $transactions]);
    }


    public function order_cancel(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = now();
        $order->save();
        $transaction = Transaction::where('order_id', $request->order_id)->first();
        $transaction->status = 'declined';
        $transaction->save();
        return redirect()->route('user.orders')->with('success', 'Order Canceled Successfully');
    }

    public function address(Request $request)
    {

        $defaultAddress = Address::where('user_id', auth()->id())->where('is_default', 1)->first();
        $otherAddresses = Address::where('user_id', auth()->id())->where('is_default', 0)->get();
        // dd($otherAddress);
        return view('user.address', ['defaultAddress' => $defaultAddress, 'otherAddresses' => $otherAddresses]);
    }

    public  function address_add()
    {
        return view('user.address-add');
    }

    public function address_store(Request $request)
    {
        $fields = [
            'name' => 'required|string|max:100',
            'phone' => 'required|numeric|digits:11',
            'zip' => 'required|numeric|digits:4',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'locality' => 'required|string|max:255',
            'landmark' => 'required|string|max:255',
            'is_default' => 'required|boolean',
        ];

        $validator = validator($request->all(), $fields);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // যদি নতুন এড্রেস **default** হয়, তাহলে আগের **default address** গুলো reset করে দিতে হবে।
        if ($request->is_default == 1) {
            Address::where('user_id', Auth::id())->update(['is_default' => 0]);
        }

        // নতুন Address সংরক্ষণ
        $address = new Address();
        $address->user_id = Auth::id();
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->country = 'Bangladesh';
        $address->is_default = $request->is_default;
        $address->save();

        return redirect()->route('user.address')->with('success', 'Address Added Successfully');
    }

    public function address_edit($id)
    {
        $address = Address::find($id);
        return view('user.address-edit', ['address' => $address]);
    }

    public function address_update(Request $request, $id)
    {

        $fields = [
            'name' => 'required|string|max:100',
            'phone' => 'required|numeric|digits:11',
            'zip' => 'required|numeric|digits:4',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'locality' => 'required|string|max:255',
            'landmark' => 'required|string|max:255',
            'is_default' => 'required|boolean',
        ];

        $validator = validator($request->all(), $fields);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // যদি নতুন এড্রেস **default** হয়, তাহলে আগের **default address** গুলো reset করে দিতে হবে।
        if ($request->is_default == 1) {
            Address::where('user_id', Auth::id())->update(['is_default' => 0]);
        }

        $address_id = Address::findOrFail($id);

        $address_id->name = $request->name;
        $address_id->phone = $request->phone;
        $address_id->zip = $request->zip;
        $address_id->state = $request->state;
        $address_id->city = $request->city;
        $address_id->address = $request->address;
        $address_id->locality = $request->locality;
        $address_id->landmark = $request->landmark;
        $address_id->country = 'Bangladesh';
        $address_id->is_default = $request->is_default;
        $address_id->save();

        return redirect()->route('user.address')->with('success', 'Address Updated Successfully');
    }


    public function set_default(Request $request, $id)
    {

        $address_id = Address::findOrFail($id);
        $address_id->is_default = 1;
        if ($address_id->is_default == 1) {
            Address::where('user_id', Auth::id())->update(['is_default' => 0]);
        }
        $address_id->save();
        return redirect()->route('user.address')->with('success', 'Default Address  Updated Successfully');
    }

    public function account_details()
    {
        return view('user.account-details');
    }

    public function account_details_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'mobile' => 'required|numeric|digits:11|unique:users,mobile,' . $id,
            'old_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|required_with:old_password|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;

        if ($request->filled('new_password')) {
            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
