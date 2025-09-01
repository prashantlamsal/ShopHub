@extends('layouts.app')
@section('title', 'Admin Dashboard - ShopHub')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
            <div class="flex space-x-4">
                <a href="{{ route('categories.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-tags mr-2"></i>Manage Categories
                </a>
                <a href="{{ route('products.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-box mr-2"></i>Manage Products
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-shopping-cart mr-2"></i>Manage Orders
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Category Card -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Categories</h2>
                        <p class="text-3xl font-bold text-gray-800">{{$totalcategories}}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-tags text-2xl text-blue-500"></i>
                    </div>
                </div>
            </div>

            <!-- Product Card -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Products</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalproducts }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-box text-2xl text-purple-500"></i>
                    </div>
                </div>
            </div>

            <!-- Order Card -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Orders</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-shopping-bag text-2xl text-green-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Status</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <!-- Pending Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <i class="fas fa-clock text-xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Pending Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">{{ $pendingOrders }}</p>
            </div>

            <!-- Processing Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-blue-100 p-2 rounded-full">
                        <i class="fas fa-cog text-xl text-blue-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Processing Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">{{ $processingOrders }}</p>
            </div>

            <!-- Shipped Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-purple-100 p-2 rounded-full">
                        <i class="fas fa-shipping-fast text-xl text-purple-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Shipped Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">{{ $shippedOrders }}</p>
            </div>

            <!-- Delivered Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i class="fas fa-check text-xl text-green-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Delivered Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">{{ $deliveredOrders }}</p>
            </div>

            <!-- Cancelled Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-red-100 p-2 rounded-full">
                        <i class="fas fa-times text-xl text-red-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Cancelled Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">{{ $cancelledOrders }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('categories.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                    <i class="fas fa-plus text-blue-600 mr-3"></i>
                    <span class="text-blue-800 font-medium">Add Category</span>
                </a>
                <a href="{{ route('products.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                    <i class="fas fa-plus text-green-600 mr-3"></i>
                    <span class="text-green-800 font-medium">Add Product</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                    <i class="fas fa-shopping-cart text-purple-600 mr-3"></i>
                    <span class="text-purple-800 font-medium">Manage Orders</span>
                </a>
                <a href="#" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                    <i class="fas fa-users text-orange-600 mr-3"></i>
                    <span class="text-orange-800 font-medium">Manage Users</span>
                </a>
            </div>
        </div>
    </div>
@endsection
