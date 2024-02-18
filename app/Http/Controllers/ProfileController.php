<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Image;

class ProfileController extends Controller
{
    public function profile(){
        return view('admin.profile.profile');
    }

    public function name_update(Request $request){
        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);
        return back();
    }

    public function password_update(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()->mixedCase(),'confirmed'],
            'password_confirmation' => 'required',
        ],[
            'old_password.required' => 'Please enter your old password first!',
            'password.required' => 'Please enter new password!',
            'password_confirmation.required' => 'Please enter new password again!',
            'password.confirmed' => 'Passwords does not matched!',
            'password.min' => 'Your password must contain at least one number, uppercase letter, lowercase letter, and special character!',
        ]);

        if(Hash::check($request->old_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password' => bcrypt($request->password),
            ]);
            return back()->with('success', 'Change hoise tor koster password!');
        }else{
            return back()->with('wrong_pass', 'Oi batpar vag taratari!!!');
        }
    }

    public function photo_update(Request $request){
        $profile_photo = $request->profile_photo;
        if(Auth::user()->profile_photo != 'default.png'){
            $path = public_path('uploads/profile/'.Auth::user()->profile_photo);
            unlink($path);

            $extension = $profile_photo->getClientOriginalExtension();
            $profile_photo_name = Auth::id().'.'.$extension;

            Image::make($profile_photo)->save(public_path('uploads/profile/'.$profile_photo_name));
            User::find(Auth::id())->update([
                'profile_photo' => $profile_photo_name,
            ]);
            return back();
        }else{
            $extension = $profile_photo->getClientOriginalExtension();
            $profile_photo_name = Auth::id().'.'.$extension;

            Image::make($profile_photo)->save(public_path('uploads/profile/'.$profile_photo_name));
            User::find(Auth::id())->update([
                'profile_photo' => $profile_photo_name,
            ]);
            return back();
        }
    }
}
