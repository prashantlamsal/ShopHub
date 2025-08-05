<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalcategories = Category::count();
        $totalproducts = Product::count();
        
        // Get order statistics
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        return view('dashboard', compact(
            'totalcategories', 
            'totalproducts', 
            'totalOrders', 
            'pendingOrders', 
            'processingOrders', 
            'shippedOrders', 
            'deliveredOrders', 
            'cancelledOrders'
        ));
    }
}
