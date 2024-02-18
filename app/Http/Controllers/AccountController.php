<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderProductDetails;
use Carbon\Carbon;
use PDF;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customerlogin');
    }

    public function account(){
        $orders = Order::where('user_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.account', [
            'orders' => $orders,
        ]); 
    }

    public function customerlogout(Request $request){
        Auth::guard('customerlogin')->logout();
        return redirect()->route('customer.register.form');
    }

    public function invoice($invoice_id){
        $billing_info = BillingDetails::where('order_id', $invoice_id)->get();
        $product_info = OrderProductDetails::where('order_id', $invoice_id)->get();
        $order_info = Order::where('id', $invoice_id)->get();
        $data = [
            'billing_info' => $billing_info,
            'product_info' => $product_info,
            'order_info' => $order_info,
        ];
        $pdf = PDF::loadView('frontend.invoice', $data);
        return $pdf->stream('valorant.pdf');
    }

    public function customerEmailVerify($token){
        $token_check = CustomerEmailVerify::where('token', $token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($token_check->customer_id);

        $customer->update([
            'email_verified_at' => Carbon::now(),
        ]);

        $verified_info = CustomerEmailVerify::where('customer_id', $customer->id)->delete();

        return back();
    }
}
