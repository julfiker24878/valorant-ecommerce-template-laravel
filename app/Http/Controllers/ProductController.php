<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Color;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function add_product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();
        return view('admin.product.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ]);
    }

    public function view_product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();
        return view('admin.product.view', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ]);
    }

    public function getCategory(Request $request){
        $subcategories = Subcategory::where('category_id', $request->cat_id)->get();
        $str_to_send = '<option>-- Select SubCategory --</option>';
        foreach($subcategories as $subcategory){
            $str_to_send .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str_to_send;
    }

    public function insert(Request $request){
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_discount' => $request->discount,
            'after_discount' => ($request->product_price - ($request->product_price*$request->discount/100)),
            'brand' => $request->brand_name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        $preview_image = $request->product_preview;
        $extension = $preview_image->getClientOriginalExtension();
        $preview_image_name = $product_id.'.'.$extension;

        Image::make($preview_image)->save(public_path('/uploads/products/preview/'.$preview_image_name));

        Product::find($product_id)->update([
            'preview' => $preview_image_name,
        ]);

        $loop = 1;
        $thumbnail_images = $request->product_thumbnails;
        foreach($thumbnail_images as $thumbnail_image){
            $extension = $thumbnail_image->getClientOriginalExtension();
            $thumbnail_images_name = $product_id.'-'.$loop.'.'.$extension;

            Image::make($thumbnail_image)->save(public_path('/uploads/products/thumbnails/'.$thumbnail_images_name));
            $loop++;

            ProductThumbnail::insert([
                'product_id' => $product_id,
                'product_thumbnails' => $thumbnail_images_name,
                'created_at' => Carbon::now(),
            ]);
        }
        return back();

    }

    public function color(){
        $colors = Color::all();
        return view('admin.product.add_color', [
            'colors' => $colors,
        ]);
    }


}
