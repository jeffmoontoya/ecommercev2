<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{

    public function getAllProducts()
    {
        $products = Product::with('Category')->get();
        return response()->json(['products' => $products], 200);
    }


    public function showProduct(Product $product)
    {
        $product->load('category');
        return view('products.product', compact('product'));
    }


    public function saveProduct(Request $request){
        $product = new Product($request->all());
        $this->uploadImages($request, $product);
        $product->save();
        return response()->json(['product' => $product], 200);
    }

    public function getAProduct(Product $product){
        $product->load('category');
        return response()->json(['product' => $product], 200);
    }

    public function updateProduct(Request $request, Product $product){
        $requestAll = $request->all();
        $this->uploadImages($request, $product);
        $requestAll['product_image'] = $product->product_image;
        $product->update($requestAll);
        return response()->json(['product' => $product->refresh()->load('Category')], 201);

    }

    public function deleteProduct(Product $product){
        $product->delete();
        return response()->json([], 204);
    }
	private function uploadImages($request, &$product)
	{
		if (!isset($request->product_image)) return;
		$random = Str::random(20);
		$image_name = "{$random}.{$request->product_image->clientExtension()}";
		$request->product_image->move(storage_path('app/public/images'), $image_name);
		$product->product_image = $image_name;
	}
}

