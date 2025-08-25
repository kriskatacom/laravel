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
        $category = Category::find($id);
        return view("admin.categories.show", compact("category"));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        return view("admin.categories.delete", compact("category"));
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route("dashboard.categories.index")
                ->with("error", "Категорията не е намерена.");
        }

        if ($category->delete()) {
            return redirect()->route("dashboard.categories.index")
                ->with("success", "Категорията беше изтрита успешно.");
        }

        return redirect()->route("dashboard.categories.index")
            ->with("error", "Възникна грешка при изтриване на категорията.");
    }
}
