@extends('layouts.master')
@section('title', 'Checkout - ShopHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Checkout Form -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Shipping Information</h2>
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Shipping Address *
                            </label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Enter your complete shipping address">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Billing Address *
                            </label>
                            <textarea name="billing_address" id="billing_address" rows="3" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Enter your billing address">{{ old('billing_address') }}</textarea>
                            @error('billing_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number *
                            </label>
                            <input type="tel" name="phone" id="phone" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter your phone number" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Order Notes (Optional)
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Any special instructions for your order">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex items-center space-x-4">
                            <input type="checkbox" id="same_address" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="same_address" class="text-sm text-gray-700">Use same address for billing</label>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/products/'.$item->product->photopath) }}" 
                             alt="{{ $item->product->name }}" 
                             class="w-16 h-16 object-cover rounded-lg">
                        
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                            <p class="text-blue-600 font-semibold">Rs. {{ number_format($item->price) }} each</p>
                        </div>
                        
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">Rs. {{ number_format($item->price * $item->quantity) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t pt-4 space-y-3">
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
                
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold text-blue-800 mb-2">Payment Information</h3>
                    <p class="text-sm text-blue-700">Payment will be collected upon delivery. We accept cash and card payments.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('same_address').addEventListener('change', function() {
    const shippingAddress = document.getElementById('shipping_address').value;
    const billingAddress = document.getElementById('billing_address');
    
    if (this.checked) {
        billingAddress.value = shippingAddress;
    }
});
</script>
@endsection 