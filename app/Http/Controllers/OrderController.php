<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Notifications\OrderPlaced;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderItems.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->with('orderItems.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000'
        ]);

        $cartItems = auth()->user()->cart()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'status' => Order::STATUS_PENDING,
                'payment_status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'phone' => $request->phone,
                'notes' => $request->notes
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);

                // Decrease product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            auth()->user()->cart()->delete();

            // Send order confirmation email
            auth()->user()->notify(new OrderPlaced($order));

            return redirect()->route('orders.show', $order->id)
                            ->with('success', 'Order placed successfully! Your order number is: ' . $order->order_number);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while placing your order. Please try again.');
        }
    }

    public function cancel(Request $request, $id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        
        if (!$order->canBeCancelled()) {
            return redirect()->back()->with('error', 'This order cannot be cancelled.');
        }

        try {
            $order->cancel($request->cancellation_reason);
            
            return redirect()->route('orders.show', $order->id)
                            ->with('success', 'Order cancelled successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel order. Please try again.');
        }
    }
}
