<?php

namespace App\Http\Controllers;

use File;
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
        return view("admin.categories.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $category->image_url = '/images/categories/' . $imageName;
        }

        $category->save();

        if ($request->action === 'save_and_index') {
            return redirect()->route('dashboard.categories.index')
                ->with('success', 'Категорията е създадена успешно.');
        }

        return redirect()->route('dashboard.categories.create')
            ->with('success', 'Категорията е създадена успешно.');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view("admin.categories.show", compact("category"));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view("admin.categories.edit", compact("category", "categories"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $id,
        ]);

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route("dashboard.categories.index")
                ->with("error", "Категорията не е намерена.");
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $category->image_url = '/images/categories/' . $imageName;
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        if ($request->input('action') === 'save_and_index') {
            return redirect()->route('dashboard.categories.index')
                ->with('success', 'Категорията е актуализирана успешно.');
        }

        return redirect()->back()->with('success', 'Категорията е актуализирана успешно.');
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

        if ($category->image_url) {
            $imagePath = public_path($category->image_url);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($category->delete()) {
            return redirect()->route("dashboard.categories.index")
                ->with("success", "Категорията беше изтрита успешно.");
        }

        return redirect()->route("dashboard.categories.index")
            ->with("error", "Възникна грешка при изтриване на категорията.");
    }

    public function destroyAll()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            if ($category->image_url) {
                $imagePath = public_path($category->image_url);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        Category::truncate();

        return redirect()->route("dashboard.categories.index")
            ->with("success", "Всички категории и техните снимки бяха изтрити.");
    }
}
