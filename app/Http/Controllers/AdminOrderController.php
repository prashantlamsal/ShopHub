<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderStatusUpdated;
use App\Notifications\OrderCancelled;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by date
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        $orders = $query->latest()->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
            'total_amount' => 'nullable|numeric|min:0',
            'phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string|max:500',
            'billing_address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000'
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        
        $updateData = [
            'status' => $request->status,
            'notes' => $request->notes
        ];

        // Add optional fields if provided
        if ($request->filled('payment_status')) {
            $updateData['payment_status'] = $request->payment_status;
        }
        if ($request->filled('total_amount')) {
            $updateData['total_amount'] = $request->total_amount;
        }
        if ($request->filled('phone')) {
            $updateData['phone'] = $request->phone;
        }
        if ($request->filled('shipping_address')) {
            $updateData['shipping_address'] = $request->shipping_address;
        }
        if ($request->filled('billing_address')) {
            $updateData['billing_address'] = $request->billing_address;
        }

        $order->update($updateData);

        // If order is cancelled, restore product stock
        if ($request->status === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                $product = $item->product;
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        // If order is being uncancelled, reduce product stock
        if ($oldStatus === 'cancelled' && $request->status !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                $product = $item->product;
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        }

        // Send email notification if status changed
        if ($oldStatus !== $request->status) {
            if ($request->status === 'cancelled') {
                $order->user->notify(new OrderCancelled($order, $request->notes));
            } else {
                $order->user->notify(new OrderStatusUpdated($order, $oldStatus, $request->status));
            }
        }

        return redirect()->route('admin.orders.show', $order->id)
                        ->with('success', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Restore product stock if order is not cancelled
        if ($order->status !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                $product = $item->product;
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
                        ->with('success', 'Order deleted successfully!');
    }

    public function getOrderStats()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        return [
            'total' => $totalOrders,
            'pending' => $pendingOrders,
            'processing' => $processingOrders,
            'shipped' => $shippedOrders,
            'delivered' => $deliveredOrders,
            'cancelled' => $cancelledOrders
        ];
    }
} 