<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showHomeWithCategories()
    {
        $categories = $this->getAllCategories();
        return view('home', compact('categories'));
    }

    public function showCategoryProducts(Category $category)
    {
        $category->load('products');
        return view('categories.category', compact('category'));
    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return $categories;
    }

    public function getCategories()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories], 200);
    }

    public function saveCategory(Request $request){
        $category = new Category($request->all());
        $category->save();
        return response()->json(['category' => $category], 200);
    }

    public function updateCategory(Request $request){
        $category = Category::find($request->id);
        $category->update($request->all());
        return response()->json(['category' => $category], 200);
    }

    public function deleteCategory(Request $request){
        $category = Category::find($request->id);
        $category->delete();
        return response()->json(['category' => $category], 200);
    }
}
