@extends('layouts.master')
@section('title', 'My Profile - ShopHub')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Home
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="relative inline-block">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/profiles/' . $user->profile_picture) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-blue-100">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-4xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="absolute bottom-0 right-0 bg-green-500 w-6 h-6 rounded-full border-2 border-white"></div>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-800 mt-4">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        @if($user->role === 'admin')
                            <span class="inline-block bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full mt-2">
                                <i class="fas fa-crown mr-1"></i>Admin
                            </span>
                        @endif
                    </div>

                    <!-- Profile Details -->
                    <div class="space-y-4">
                        @if($user->phone)
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">{{ $user->phone }}</span>
                        </div>
                        @endif

                        @if($user->address)
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-500 w-5 mt-1"></i>
                            <span class="ml-3 text-gray-700">{{ $user->address }}</span>
                        </div>
                        @endif

                        @if($user->date_of_birth)
                        <div class="flex items-center">
                            <i class="fas fa-birthday-cake text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('F d, Y') }}</span>
                        </div>
                        @endif

                        <div class="flex items-center">
                            <i class="fas fa-calendar text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">Member since {{ $user->created_at->format('F Y') }}</span>
                        </div>
                    </div>

                    @if($user->bio)
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-2">About Me</h3>
                        <p class="text-gray-600">{{ $user->bio }}</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('profile.edit') }}" 
                           class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-center block">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </a>
                        <a href="{{ route('orders.index') }}" 
                           class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-center block">
                            <i class="fas fa-shopping-bag mr-2"></i>View All Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders & Stats -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-shopping-bag text-blue-500"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Orders</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $user->orders()->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Completed</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $user->orders()->where('status', 'delivered')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-clock text-yellow-500"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pending</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $user->orders()->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Orders</h2>
                </div>
                
                @if($orders->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-800">Order #{{ $order->order_number }}</h3>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-500">{{ $order->orderItems->count() }} items</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-blue-600">Rs. {{ number_format($order->total_amount) }}</p>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $order->getStatusBadgeClass() }}">
                                    <i class="{{ $order->getStatusIcon() }} mr-1"></i>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('orders.show', $order->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View Details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-6 text-center">
                    <i class="fas fa-shopping-bag text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">No orders yet</p>
                    <a href="{{ route('products.all') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Start Shopping <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 