<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\CustomerPassReset;
use App\Notifications\PassResetNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Notification;
use Hash;

class CustomerPasswordController extends Controller
{
    public function password_reset_req(){
        return view('customer_password_reset');
    }

    public function password_reset_store(Request $request){
        $customer = CustomerLogin::where('email', $request->email)->firstOrFail();
        $password_reset = CustomerPassReset::where('customer_id', $customer->id)->delete();

        $password_reset = CustomerPassReset::create([
            'customer_id' => $customer->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::send($customer, new PassResetNotification($password_reset));
    }

    public function password_reset_req_form($token){
        return view('customer_password_reset_form', compact('token'));
    }

    public function pass_update(Request $request){
        $password_reset = CustomerPassReset::where('token', $request->token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($password_reset->customer_id);

        $customer->update([
            'password' => Hash::make($request->password),
        ]);

        $password_reset = CustomerPassReset::where('customer_id', $customer->id)->delete();
    }
}
