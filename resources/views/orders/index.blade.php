@extends('layouts.master')
@section('title', 'My Orders - ShopHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">My Orders</h1>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Order #{{ $order->order_number }}</h3>
                            <p class="text-sm text-gray-600">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                            @if($order->cancelled_at)
                                <p class="text-sm text-red-600">Cancelled on {{ $order->cancelled_at->format('M d, Y') }}</p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $order->getStatusBadgeClass() }}">
                                <i class="{{ $order->getStatusIcon() }} mr-1"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                            <span class="text-lg font-bold text-blue-600">Rs. {{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Order Items</h4>
                            <div class="space-y-3">
                                @foreach($order->orderItems as $item)
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('images/products/'.$item->product->photopath) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-12 h-12 object-cover rounded">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">Qty: {{ $item->quantity }} × Rs. {{ number_format($item->price) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Shipping Information</h4>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                @if($order->notes)
                                    <p><strong>Notes:</strong> {{ $order->notes }}</p>
                                @endif
                                @if($order->cancellation_reason)
                                    <p><strong>Cancellation Reason:</strong> {{ $order->cancellation_reason }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            @if($order->canBeCancelled())
                                <button onclick="showCancelModal('{{ $order->id }}', '{{ $order->order_number }}')" 
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition mr-3">
                                    <i class="fas fa-times mr-1"></i>Cancel Order
                                </button>
                            @endif
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-bag text-3xl text-gray-400"></i>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">No orders yet</h2>
            <p class="text-gray-600 mb-8">You haven't placed any orders yet. Start shopping to see your orders here.</p>
            <a href="{{ route('products.all') }}" 
               class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>

<!-- Cancel Order Modal -->
<div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Cancel Order</h3>
                <button onclick="hideCancelModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <p class="text-gray-600 mb-4">Are you sure you want to cancel order <span id="orderNumber" class="font-semibold"></span>?</p>
            
            <form id="cancelForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="cancellation_reason" class="block text-sm font-medium text-gray-700 mb-2">
                        Reason for cancellation (optional)
                    </label>
                    <textarea name="cancellation_reason" id="cancellation_reason" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Please let us know why you're cancelling this order..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideCancelModal()" 
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Keep Order
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Cancel Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showCancelModal(orderId, orderNumber) {
    document.getElementById('orderNumber').textContent = orderNumber;
    document.getElementById('cancelForm').action = `/orders/${orderId}/cancel`;
    document.getElementById('cancelModal').classList.remove('hidden');
}

function hideCancelModal() {
    document.getElementById('cancelModal').classList.add('hidden');
    document.getElementById('cancellation_reason').value = '';
}

// Close modal when clicking outside
document.getElementById('cancelModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideCancelModal();
    }
});
</script>
@endsection 