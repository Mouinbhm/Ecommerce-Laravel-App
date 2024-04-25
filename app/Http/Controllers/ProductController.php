<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index')->with('products', $products);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'qte' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajout de la validation pour les images
        ]);
    
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->qte;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images', $filename);
            $product->image = $filename;
        }
    
        if ($product->save()) {
            return redirect()->back()->with('success', 'Product created successfully');
        } else {
            return redirect()->back()->with('error', 'Error creating product');
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