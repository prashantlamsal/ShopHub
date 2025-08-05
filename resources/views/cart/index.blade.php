@extends('layouts.master')
@section('title', 'Shopping Cart - ShopHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Shopping Cart</h1>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Cart Items ({{ $cartItems->count() }})</h2>
                    </div>
                    
                    <div class="divide-y">
                        @foreach($cartItems as $item)
                        <div class="p-6 flex items-center space-x-4">
                            <img src="{{ asset('images/products/'.$item->product->photopath) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-20 h-20 object-cover rounded-lg">
                            
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                <p class="text-blue-600 font-semibold">Rs. {{ number_format($item->price) }}</p>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                           class="w-16 px-2 py-1 border border-gray-300 rounded text-center">
                                    <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <div class="text-right">
                                <p class="font-semibold text-gray-800">Rs. {{ number_format($item->price * $item->quantity) }}</p>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-trash mr-1"></i>Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="p-6 border-t">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash mr-1"></i>Clear Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">Rs. {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold text-green-600">Free</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold text-gray-800">Total</span>
                                <span class="text-lg font-bold text-blue-600">Rs. {{ number_format($total) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout') }}" 
                       class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition text-center block">
                        Proceed to Checkout
                    </a>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('products.all') }}" class="text-blue-600 hover:text-blue-800">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-cart text-3xl text-gray-400"></i>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your cart is empty</h2>
            <p class="text-gray-600 mb-8">Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ route('products.all') }}" 
               class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection 