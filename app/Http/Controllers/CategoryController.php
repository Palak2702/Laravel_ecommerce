<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index() {
        return view('admin.categories.create');
    }
   

    public function store(Request $request)
    {
       $category = new ProductCategory;
       $category->name = $request->category_name;
       $category->status = 1;
       $category->save();

       return response()->json(['success' => true, 'data' => $category]);
    }


    public function fetch(){
        $categories = ProductCategory::latest()->get();
        return response()->json($categories);
    }

    public function destroy($id) {
        ProductCategory::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
