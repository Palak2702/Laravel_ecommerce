<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $categories = ProductCategory::where('status',1)->pluck('name','id');
        return view('admin.products.create' , compact('categories'));
    }


    public function store(Request $request){


        $request->validate([
            'category_id' => 'required',
            'product_name.*' => 'required|string',
            'price.*' => 'required|numeric',
            'discount_type.*' => 'nullable|in:%,rs',
            'discount.*' => 'nullable|numeric',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $category_id = $request->category_id;

       
       foreach($request->product_name  as $index => $name){
        $imagePath = null;

        if ($request->hasFile("image.$index")) {
            $image = $request->file("image.$index");
            $imagePath = $image->store('products', 'public');
        }


       

        $Products = new Product;
        $Products->category_id = $category_id;
        $Products->name = $name;
        $Products->price_per_kg_inr = $request->price[$index];
        $Products->discount_type = $request->discount_type[$index];
        $Products->discount = $request->discount[$index];
        $Products->image = $imagePath;
        $Products->status = 1;
        $Products->save();

      
        // $products->name = $Products

      
       }

       return  redirect()->route('fetch.product');

        // $products = new Product;


    }



    public function fetch(){


        $data = Product::with('category')->get();

        return  view('admin.products.list',compact('data'));
    }
}   
