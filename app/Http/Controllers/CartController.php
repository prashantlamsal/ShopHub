<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();
        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $price = $product->discounted_price ?: $product->price;

        // Check if product already in cart
        $cartItem = Cart::where('user_id', auth()->id())
                       ->where('product_id', $request->product_id)
                       ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
                'price' => $price
            ]);
            $message = 'Product quantity updated in cart!';
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $price
            ]);
            $message = 'Product added to cart successfully!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
        $productName = $cartItem->product->name;
        $cartItem->delete();

        return redirect()->back()->with('success', "{$productName} removed from cart!");
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
