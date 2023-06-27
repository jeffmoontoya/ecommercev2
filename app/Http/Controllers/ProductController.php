<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProduct(Product $product)
    {
        $product->load('category');
        return view('products.product', compact('product'));
    }

    public function getAllProducts()
    {
        $products = Product::with('Category')->get();
        return response()->json(['products' => $products], 200);
    }

    public function saveProduct(Request $request){
        $product = new Product($request->all());
        $product->save();
        return response()->json(['product' => $product], 200);
    }
}
