<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($category->save()) {
            return redirect()->back()->with('success', 'Category created successfully');
        } else {
            echo "error";
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->delete()) {
            return redirect()->back()->with('success', 'Category deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete category');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_category' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
        ]);

        $id = $request->id_category;
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->description = $request->description;
        if ($category->update()) {
            return redirect()->back()->with('success', 'Category updated successfully'); // Modification du message de réussite
        } else {
            return redirect()->back()->with('error', 'Failed to update category'); // Modification du message d'erreur
        }
    }
}
