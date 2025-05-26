<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use League\Flysystem\Plugin\GetWithMetadata;

class HomeController extends Controller
{
   public function index()
   {
      $categories = ProductCategory::with('products')->get();
      return view('customer.welcome_page', compact('categories'));
   }

   public function getProductsByCategory($categoryId)
   {
      $products = Product::where('category_id',$categoryId)->get();


      return response()->json($products);
      
   }


}
