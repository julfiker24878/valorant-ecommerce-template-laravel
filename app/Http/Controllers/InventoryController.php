<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\Inventory;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function insert_color(Request $request){
        Color::insert([
            'color_name' => $request->color,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Color has been added successfully!');
    }

    public function index_size(){
        $sizes = Size::all();
        return view('admin.product.add_size', [
            'sizes' => $sizes,
        ]);
    }

    public function insert_size(Request $request){
        Size::insert([
            'size_name' => $request->size,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Size has been added successfully!');
    }

    public function inventory($product_id){
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id', $product_id)->get();
        $product_info = Product::find($product_id);
        return view('admin.product.add_inventory', [
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
            'product_info' => $product_info,
        ]);
    }

    public function insert_inventory(Request $request){

        if( Inventory::where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists() ){
            Inventory::where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back()->with('success', 'Product Inventory added successfully!');
        }else{
            Inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Product Inventory added successfully!');
        }

    }
}
