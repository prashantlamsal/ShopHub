@extends('layouts.master')
@section('title', $category->name . ' - ShopHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $category->name }}</h1>
        <p class="text-gray-600">
            {{ $products->total() }} product(s) found in this category
        </p>
    </div>

    @if($products->count() > 0)
        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                <div class="relative overflow-hidden">
                    <a href="{{ route('viewproduct', $product->id) }}">
                        <img src="{{ asset('images/products/'.$product->photopath) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    </a>
                    @if($product->discounted_price)
                        <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            {{ round((($product->price - $product->discounted_price) / $product->price) * 100) }}% OFF
                        </div>
                    @endif
                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition inline-block">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        @endauth
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-blue-600 font-medium">{{ $product->category->name }}</span>
                        <div class="flex items-center text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $product->average_rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                            <span class="text-gray-500 text-sm ml-1">({{ $product->reviews_count }})</span>
                        </div>
                    </div>
                    
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('viewproduct', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($product->discounted_price)
                                <span class="font-bold text-blue-600">Rs. {{ number_format($product->discounted_price) }}</span>
                                <span class="text-gray-400 line-through text-sm">Rs. {{ number_format($product->price) }}</span>
                            @else
                                <span class="font-bold text-blue-600">Rs. {{ number_format($product->price) }}</span>
                            @endif
                        </div>
                        <span class="text-sm text-gray-500">{{ $product->stock }} in stock</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @endif
    @else
        <!-- No Products in Category -->
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-box text-3xl text-gray-400"></i>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">No products in this category</h2>
            <p class="text-gray-600 mb-8">We're currently updating our inventory for this category. Please check back later.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.all') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Browse All Products
                </a>
                <a href="{{ route('home') }}" 
                   class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                    Back to Home
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
