<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class NavbarController extends Controller
{
    public function showNavbar()
    {
        $categories = Category::all();
        return view('app', compact('categories'));
    }
}



