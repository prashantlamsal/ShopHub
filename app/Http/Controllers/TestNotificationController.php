<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\OrderPlaced;
use App\Notifications\OrderStatusUpdated;
use App\Notifications\OrderCancelled;
use Illuminate\Http\Request;

class TestNotificationController extends Controller
{
    public function testOrderPlaced()
    {
        $order = Order::with('user')->first();
        
        if (!$order) {
            return response()->json(['error' => 'No orders found. Please create an order first.']);
        }

        $order->user->notify(new OrderPlaced($order));
        
        return response()->json([
            'success' => true,
            'message' => 'Order placed notification sent successfully!',
            'order_number' => $order->order_number,
            'user_email' => $order->user->email
        ]);
    }

    public function testOrderStatusUpdated()
    {
        $order = Order::with('user')->first();
        
        if (!$order) {
            return response()->json(['error' => 'No orders found. Please create an order first.']);
        }

        $oldStatus = $order->status;
        $newStatus = 'processing';
        
        $order->user->notify(new OrderStatusUpdated($order, $oldStatus, $newStatus));
        
        return response()->json([
            'success' => true,
            'message' => 'Order status updated notification sent successfully!',
            'order_number' => $order->order_number,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'user_email' => $order->user->email
        ]);
    }

    public function testOrderCancelled()
    {
        $order = Order::with('user')->first();
        
        if (!$order) {
            return response()->json(['error' => 'No orders found. Please create an order first.']);
        }

        $order->user->notify(new OrderCancelled($order, 'Test cancellation reason'));
        
        return response()->json([
            'success' => true,
            'message' => 'Order cancelled notification sent successfully!',
            'order_number' => $order->order_number,
            'user_email' => $order->user->email
        ]);
    }
} 