<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    function customer_login(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])){
            
            if(Auth::guard('customerlogin')->user->email_verified_at == Null){
                echo "not verified";
            }else{
                return redirect('/');
            }

        }else{
            return redirect('/register');
        }
    }
}
