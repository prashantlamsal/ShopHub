<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('order', 'asc')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'order' => 'required|integer|min:1',
        ]);

        try {
            Category::create($data);
            return redirect()->route('categories.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'order' => 'required|integer|min:1',
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update($data);
            return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            
            // Check if category has products
            if ($category->products()->count() > 0) {
                return redirect()->route('categories.index')->with('error', 'Cannot delete category that has products. Please remove all products first.');
            }
            
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete category. Please try again.');
        }
    }
}
