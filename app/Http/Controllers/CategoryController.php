<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showHomeWithCategories()
    {
        $categories = $this->getAllCategories()->filter(function ($category) {
            return $category->products()->exists();
        });

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
        return response()->json(['Category' => $category], 201);
    }


    public function updateCategory(Category $category , Request $request){
        $category->update($request->all());
        return response()->json(['Category' => $category], 201);
    }

    public function deleteCategory(Category $category){
        $category->delete();
        return response()->json([], 204);
    }

    public function getCategory(Category $category){
        return response()->json(['category' => $category], 200);
    }


}
