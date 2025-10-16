<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function coupons()
    {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(5);
        // dd($coupons);
        return view('admin.coupons.coupons', ['coupons' => $coupons]);
    }

    public function coupon_add(Request $request)
    {
        return view('admin.coupons.coupon-add');
    }
    public function coupon_store(Request $request)
    {


        $filed = [
            'code' => 'required|string|max:255|unique:coupons,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $filed);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }


        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();

        // Coupon::create([
        //     'code' => $request->code,
        //     'type' => $request->type,
        //     'value' => $request->value,
        //     'cart_value' => $request->cart_value,
        //     'expiry_date' => $request->expiry_date
        // ]);
        return Redirect::route('admin.coupons')->with('success', 'Coupon created successfully');
    }


    public function coupon_edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.coupon-edit', ['coupon' => $coupon]);
    }

    public function coupon_update(Request $request, $id)
    {


        $filed = [
            'code' => "required|string|max:255|unique:coupons,code,{$id}",
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date',
        ];

        $coupon = Coupon::findOrFail($id);
        $validator = Validator::make($request->all(), $filed);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $coupon->update([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'cart_value' => $request->cart_value,
            'expiry_date' => $request->expiry_date
        ]);

        return Redirect::route('admin.coupons')->with('success', 'Coupon with id ' . $id . ' updated successfully');
    }

    public function coupon_destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return Redirect::route('admin.coupons')->with('success', 'Coupon with id ' . $id . ' deleted successfully');
    }
}
