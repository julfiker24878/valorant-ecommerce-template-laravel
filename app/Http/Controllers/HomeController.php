<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $total_users = User::all()->count();
        $users = User::where('id', '!=', Auth::user()->id)->paginate(5);
        $logged_user = Auth::user()->name;

        return view('home', [
            'total_users' => $total_users,
            'users' => $users,
            'logged_user' => $logged_user,
        ]);
    }

    public function admin(){
        $users = User::all();
        $products = Product::take(4)->orderBy('id', 'DESC')->get();
        $all_products = Product::all();
        $categories = Category::all();
        $sub_categories = Subcategory::all();
        return view('admin', [
            'users' => $users,
            'products' => $products,
            'all_products' => $all_products,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }

    public function delete($user_id){
        User::find($user_id)->delete();
        return back();
    }

    public function dashboard(){
        return view('layouts.dashboard');
    }
}
