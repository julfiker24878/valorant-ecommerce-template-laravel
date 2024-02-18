<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use App\Http\Requests\CategoryRequest;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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

    public function index(){
        $categories = Category::all();
        $trashed = Category::onlyTrashed()->get();
        return view('admin.categories.index', [
            'categories' => $categories,
            'trashed' => $trashed,
        ]);
    }

    public function insert(CategoryRequest $request){

        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => carbon::now(),
        ]);

        $category_image = $request->category_image;
        $extension = $category_image->getClientOriginalExtension();
        $category_image_name = $category_id.'.'.$extension;

        Image::make($category_image)->save(public_path('uploads/category/'.$category_image_name));

        Category::find($category_id)->update([
            'category_image' => $category_image_name,
        ]);

        return back()->with('success', 'Category added!');
    }

    public function delete($cat_id){
        Category::find($cat_id)->delete();
        return back()->with('deleted', 'Category has been deleted!');
    }

    public function edit($cat_id){
        $cat_name = Category::find($cat_id);
        return view('admin.categories.edit', compact('cat_name'));
    }

    public function update(Request $request){

        Category::find($request->id)->update([
            'category_name' => $request->category_name,
            'updated_at' => carbon::now(),
        ]);

        $category_image = $request->category_iamge;
        $category_image_extension = $category_image->getClientOriginalExtension();
        $category_image_name = $request->id.'.'.$category_image_extension;

        $delete_from = public_path('/uploads/category/').Category::find($request->id)->category_image;
        unlink($delete_from);

        Image::make($category_image)->save(public_path('/uploads/category/'.$category_image_name));

        Category::find($request->id)->update([
            'category_image' => $category_image_name,
        ]);

        return redirect('/category')->with('success', 'Save Changed!');
    }

    public function restore($cat_restore){
        Category::onlyTrashed()->find($cat_restore)->restore();
        return back();
    }

    public function force_delete($force_delete){
        $subcategory = Subcategory::all()->where('category_id','=',$force_delete);
        foreach($subcategory as $item){
            Subcategory::find($item->id)->delete();
        }
        $delete_img = public_path('/uploads/category/').Category::onlyTrashed()->find($force_delete)->category_image;
        unlink($delete_img);
        Category::onlyTrashed()->find($force_delete)->forceDelete();
        return back();
    }

















}
