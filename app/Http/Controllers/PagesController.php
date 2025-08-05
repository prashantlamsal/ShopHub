<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::with('category')->where('stock', '>', 0)->take(8)->get();
        $latestProducts = Product::with('category')->where('stock', '>', 0)->latest()->take(4)->get();
        $categories = Category::withCount('products')->orderBy('order', 'asc')->get();
        
        return view('welcome', compact('featuredProducts', 'latestProducts', 'categories'));
    }

    public function allProducts()
    {
        $products = Product::with('category')->where('stock', '>', 0)->paginate(12);
        return view('products.all', compact('products'));
    }

    public function viewProduct($id)
    {
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->where('stock', '>', 0)
                                 ->take(4)->get();
        
        return view('viewproduct', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Product::with('category')
                          ->where('name', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%")
                          ->where('stock', '>', 0)
                          ->paginate(12);
        
        return view('search', compact('products', 'query'));
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = Product::with('category')
                             ->where('name', 'like', "%{$query}%")
                             ->orWhere('description', 'like', "%{$query}%")
                             ->where('stock', '>', 0)
                             ->take(8)
                             ->get()
                             ->map(function ($product) {
                                 return [
                                     'id' => $product->id,
                                     'name' => $product->name,
                                     'category' => $product->category->name,
                                     'price' => $product->discounted_price ?: $product->price,
                                     'image' => asset('images/products/' . $product->photopath),
                                     'url' => route('viewproduct', $product->id)
                                 ];
                             });

        return response()->json($suggestions);
    }

    public function categoryProducts($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $products = $category->products()->where('stock', '>', 0)->paginate(12);
        
        return view('categoryproducts', compact('category', 'products'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function testAlerts()
    {
        return view('test-alerts');
    }
}
