<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view("admin.categories.index", compact("categories"));
    }

    public function create()
    {
        $categories = Category::all();
        view("categories.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Категорията е създадена успешно.');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
