@extends('layouts.master')
@section('title', 'Edit Order - Admin - ShopHub')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Order Details
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b bg-gray-50">
            <h1 class="text-2xl font-bold text-gray-800">Edit Order #{{ $order->order_number }}</h1>
            <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
        </div>

        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="p-6">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Order Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Order Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Payment Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Status</label>
                    <select name="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <!-- Customer Information -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                    <input type="text" value="{{ $order->user->name }}" disabled 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                    <input type="email" value="{{ $order->user->email }}" disabled 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                </div>

                <!-- Contact Information -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ $order->phone }}" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Total Amount</label>
                    <input type="number" name="total_amount" value="{{ $order->total_amount }}" step="0.01" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Addresses -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Shipping Address</label>
                    <textarea name="shipping_address" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $order->shipping_address }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Billing Address</label>
                    <textarea name="billing_address" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $order->billing_address }}</textarea>
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                    <textarea name="notes" rows="4" placeholder="Add admin notes about this order..." 
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $order->notes }}</textarea>
                </div>
            </div>

            <!-- Order Items Summary -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="space-y-3">
                        @foreach($order->orderItems as $item)
                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('images/products/' . $item->product->photopath) }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-12 h-12 object-cover rounded-lg">
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-800">Rs. {{ number_format($item->price) }}</p>
                                <p class="text-sm text-gray-600">Total: Rs. {{ number_format($item->price * $item->quantity) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i>Update Order
                </button>
                <a href="{{ route('admin.orders.show', $order->id) }}" 
                   class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 