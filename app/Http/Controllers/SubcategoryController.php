<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Carbon\Carbon;

class SubcategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $subcategoeis = Subcategory::all();
        return view('admin.subcategories.index', [
            'categories' => $categories,
            'subcategoeis' => $subcategoeis,
        ]);
    }

    public function insert(Request $request){
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Subcategory Added!');
    }
}
