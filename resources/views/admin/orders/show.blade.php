@extends('layouts.master')
@section('title', 'Order Details - Admin - ShopHub')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Order Header -->
                <div class="p-6 border-b bg-gray-50">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->order_number }}</h1>
                            <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                            @if($order->cancelled_at)
                                <p class="text-red-600">Cancelled on {{ $order->cancelled_at->format('F d, Y \a\t g:i A') }}</p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $order->getStatusBadgeClass() }}">
                                <i class="{{ $order->getStatusIcon() }} mr-1"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                            <span class="text-2xl font-bold text-blue-600">Rs. {{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                            <img src="{{ asset('images/products/' . $item->product->photopath) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-800">Rs. {{ number_format($item->price) }}</p>
                                <p class="text-sm text-gray-600">Total: Rs. {{ number_format($item->price * $item->quantity) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping & Billing -->
                <div class="p-6 border-t">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Shipping Address</h4>
                            <p class="text-gray-600">{{ $order->shipping_address }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Billing Address</h4>
                            <p class="text-gray-600">{{ $order->billing_address }}</p>
                        </div>
                    </div>
                    @if($order->notes)
                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Order Notes</h4>
                        <p class="text-gray-600">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Info & Actions -->
        <div class="space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Name</label>
                        <p class="text-gray-800">{{ $order->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="text-gray-800">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Phone</label>
                        <p class="text-gray-800">{{ $order->phone }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Member Since</label>
                        <p class="text-gray-800">{{ $order->user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Actions</h3>
                
                <!-- Status Update Form -->
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                        <textarea name="notes" rows="3" placeholder="Add admin notes..." 
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $order->notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i>Update Order
                    </button>
                </form>

                <!-- Quick Actions -->
                <div class="mt-6 space-y-2">
                    <a href="{{ route('admin.orders.edit', $order->id) }}" 
                       class="block w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-center">
                        <i class="fas fa-edit mr-2"></i>Edit Order
                    </a>
                    
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition"
                                onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                            <i class="fas fa-trash mr-2"></i>Delete Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 