@extends('layouts.master')
@section('title', 'Order Details - ShopHub')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Orders
        </a>
    </div>

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

        <!-- Order Details -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Order Items -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                        <div class="flex items-center space-x-4 p-4 border rounded-lg">
                            <img src="{{ asset('images/products/'.$item->product->photopath) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-16 h-16 object-cover rounded-lg">
                            
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                <p class="text-blue-600 font-semibold">Rs. {{ number_format($item->price) }} each</p>
                            </div>
                            
                            <div class="text-right">
                                <p class="font-bold text-gray-800">Rs. {{ number_format($item->price * $item->quantity) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Information -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Information</h2>
                    
                    <div class="space-y-6">
                        <!-- Shipping Information -->
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Shipping Address</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700">{{ $order->shipping_address }}</p>
                            </div>
                        </div>

                        <!-- Billing Information -->
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Billing Address</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700">{{ $order->billing_address }}</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Contact Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700"><strong>Phone:</strong> {{ $order->phone }}</p>
                            </div>
                        </div>

                        @if($order->notes)
                        <!-- Order Notes -->
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Order Notes</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700">{{ $order->notes }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="mt-8 border-t pt-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">Rs. {{ number_format($order->total_amount) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold text-green-600">Free</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold text-gray-800">Total</span>
                                <span class="text-lg font-bold text-blue-600">Rs. {{ number_format($order->total_amount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-semibold text-blue-800 mb-2">Payment Information</h3>
                <p class="text-sm text-blue-700">
                    <strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}<br>
                    Payment will be collected upon delivery. We accept cash and card payments.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection 