<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index(Request $request){
        $coupon_code = $request->coupon;
        $message = null;
        $carts = Cart::where('user_id', Auth::guard('customerlogin')->id())->get();

        if($coupon_code == ''){
            $discount = 0;
        }else{

            if( Coupon::where('coupon_code', $coupon_code)->exists() ){
                if( Carbon::now()->format('y-m-d') > Coupon::where('coupon_code', $coupon_code)->first()->validity ){
                    $message = "Coupon Code Expired!!!";
                    $discount = 0;
                }else{
                    $discount = Coupon::where('coupon_code', $coupon_code)->first()->discount;
                }
            }else{
                $message = "Invalid Coupon Code!!!";
                $discount = 0;
            }
        }

        return view('frontend.cart', [
            'carts' => $carts,
            'discount' => $discount,
            'message' => $message,
        ]);
    }

    public function cart_insert(Request $request){

        $quantity = Inventory::where('product_id', $request->product_id)->first()->quantity;

        if($quantity >= $request->quantity){

            Cart::insert([
                'user_id' => Auth::guard('customerlogin')->id(),
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('cart', 'Cart Added Successfully!');

        }else{
            return back()->with('stockout', 'Stock limited for only: '.$quantity);
        }
    }

    public function cart_delete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    public function cart_update(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
            Cart::find($cart_id)->update([
                'quantity' => $quantity,
            ]);
        }
        return back();
    }
}
