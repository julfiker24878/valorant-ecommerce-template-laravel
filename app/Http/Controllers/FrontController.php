<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Size;
use App\Models\Color;
use App\Models\OrderProductDetails;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use Arr;

class FrontController extends Controller
{
    public function front(){

        // $recent_viewed_product_id = json_decode(Cookie::get('recent_view_products'), true);
        // if($recent_viewed_product_id != null){
        //     $recent_viewed_unique_id = array_unique($recent_viewed_product_id);
        // }
        // $final_recent = Product::find($recent_viewed_unique_id);

        $best_selling = OrderProductDetails::groupBy('product_id')
        ->selectRaw(' sum(quantity) as sum, product_id ')
        ->orderBy('quantity', 'DESC')
        // ->havingRaw('sum >= 5')
        ->get();

        $products = Product::take(6)->get();
        $new_arrivals = Product::take(4)->orderBy('id','desc')->get();
        $categories = Category::where('id', '!=', 500)->orderBy('id','desc')->limit(3)->get();
        return view('frontend.index', [
            'products' => $products,
            'categories' => $categories,
            'new_arrivals' => $new_arrivals,
            'best_selling' => $best_selling,
            // 'final_recent' => $final_recent,
        ]);
    }

    public function product_details($product_id){

        // $getProduct_id = Cookie::queue('recent_view_products', $product_id, 10);
        $getProduct_id = Cookie::get('recent_view_products');
        if(!$getProduct_id){
            $getProduct_id = "[]";
        }

        $all_id = json_decode($getProduct_id, true);
        $add_product_id = Arr::prepend($all_id, $product_id);
        $after_encode = json_encode($add_product_id);
        Cookie::queue('recent_view_products', $add_product_id, 10);


        $reviews = OrderProductDetails::where('product_id', $product_id)->where('review', '!=', null)->get();
        $product_info = Product::find($product_id);
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_id)->get();
        $available_colors = Inventory::where('product_id', $product_id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get();
        $available_sizes = Inventory::where('product_id', $product_id)->groupBy('size_id')->selectRaw('sum(size_id) as sum, size_id')->get();
        return view('frontend.product_details', [
            'product_info' => $product_info,
            'related_products' => $related_products,
            'available_colors' => $available_colors,
            'available_sizes' => $available_sizes,
            'reviews' => $reviews,
        ]);
    }

    public function getSize(Request $request){
        $available_sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        $str_to_send = '<option>Choose A Option</option>';
        foreach($available_sizes as $sizes){
            $str_to_send .= '<option value="'.$sizes->size_id.'">'.$sizes->rel_to_size->size_name.'</option>';
        }
        echo $str_to_send;
    }

    public function product_review(Request $request, $product_id){
        OrderProductDetails::where( 'user_id', Auth::guard('customerlogin')->id() )->where( 'product_id', $product_id )->first()->update([
            'star' => $request->star,
            'review' => $request->review,
        ]);
        return back();
    }

    public function shop(Request $request){

        $data = $request->all();
        $all_products = Product::where(function ($q) use ($data){
            if( !empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined' ){
                $q->where(function ($q) use ($data){
                    $q->where('product_name', 'like', '%'.$data['q'].'%');
                    $q->orWhere('short_description', 'like', '%'.$data['q'].'%');
                });
            }
            if( !empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined' ){
                $q->where('category_id', $data['category_id']);
            }
            if( !empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined' ){
                $q->whereHas('inventories', function ($q) use ($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                        $q->whereHas('rel_to_color', function ($q) use ($data){
                            $q->where('colors.id', $data['color_id']);
                        });
                    }
                    if(!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                        $q->whereHas('rel_to_size', function ($q) use ($data){
                            $q->where('sizes.id', $data['size_id']);
                        });
                    }
                });
            }
        })->get();




        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('frontend.shop', [
            'all_products' => $all_products,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }
















}

