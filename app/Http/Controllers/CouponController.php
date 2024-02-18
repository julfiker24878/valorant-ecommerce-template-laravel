<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();
        return view('admin.coupon.index', [
            'coupons' => $coupons,
        ]);
    }

    public function insert(Request $request){
        Coupon::insert([
            'coupon_code' => $request->coupon_code,
            'discount' => $request->discount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function edit($coupon_id){
        $coupon = Coupon::find($coupon_id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request){
        Coupon::find($request->id)->update([
            'coupon_code' => $request->coupon_code,
            'discount' => $request->discount,
            'validity' => $request->validity,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('success', 'The coupon has been updated!');
    }

    public function delete($coupon_id){
        Coupon::find($coupon_id)->delete();
        return back();
    }

}
