<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("index/home", compact("categories"));
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view("categories/show", compact("category"));
    }
}