<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0|lt:price',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'photopath' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            //handle file upload
            $file = $request->file('photopath');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products/'), $filename);
            $data['photopath'] = $filename;

            Product::create($data);
            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create product. Please try again.');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('order', 'asc')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
       $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0|lt:price',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'photopath' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            $product = Product::findOrFail($id);

            if($request->hasFile('photopath'))
            {
                //handle file upload
                $file = $request->file('photopath');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products/'), $filename);
                $data['photopath'] = $filename;
                //unlink old photo
                $oldphotopath = public_path('images/products/' . $product->photopath);
                if (file_exists($oldphotopath)) {
                    unlink($oldphotopath);
                }
            }
            $product->update($data);
            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            //unlink old photo
            $oldphotopath = public_path('images/products/' . $product->photopath);
            if (file_exists($oldphotopath)) {
                unlink($oldphotopath);
            }
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
