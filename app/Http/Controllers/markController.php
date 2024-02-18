<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class markController extends Controller
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

     public function trash(Request $request){
        foreach($request->mark as $mark){
            Category::find($mark)->delete();
        }
        return back();
     }

     public function restore(Request $request){

        if(empty($request->mark)){
            return back();
        }else{
            foreach($request->mark as $mark){
                Category::onlyTrashed()->find($mark)->restore();
            }
        }
        return back();

     }






















}
