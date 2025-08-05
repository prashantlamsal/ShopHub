@extends('layouts.master')
@section('title', 'ShopHub - Your One-Stop Shopping Destination')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                    Discover Amazing Products
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Shop the latest trends with unbeatable prices. Quality products delivered to your doorstep.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.all') }}" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                        Shop Now
                    </a>
                    <a href="#featured" 
                       class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition text-center">
                        Explore Categories
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/10 rounded-2xl transform rotate-3"></div>
                    <div class="relative bg-white/20 rounded-2xl p-8 backdrop-blur-sm">
                        <i class="fas fa-shopping-bag text-8xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div id="featured" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Shop by Category</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Explore our wide range of categories and find exactly what you're looking for.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('categoryproducts', $category->id) }}" 
               class="group bg-gray-50 rounded-xl p-6 text-center hover:bg-blue-50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition">
                    <i class="fas fa-tag text-2xl text-blue-600"></i>
                </div>
                <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $category->products_count }} products</p>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Featured Products</h2>
            <p class="text-gray-600">Handpicked products just for you</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('images/products/'.$product->photopath) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                    @if($product->discounted_price)
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-semibold">
                            {{ round((($product->price - $product->discounted_price) / $product->price) * 100) }}% OFF
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
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
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-blue-600 font-medium">{{ $product->category->name }}</span>
                        <div class="flex items-center text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $product->average_rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                            <span class="text-gray-500 text-sm ml-1">({{ $product->reviews_count }})</span>
                        </div>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 mb-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('viewproduct', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($product->discounted_price)
                                <span class="text-lg font-bold text-blue-600">Rs. {{ number_format($product->discounted_price) }}</span>
                                <span class="text-gray-400 line-through">Rs. {{ number_format($product->price) }}</span>
                            @else
                                <span class="text-lg font-bold text-blue-600">Rs. {{ number_format($product->price) }}</span>
                            @endif
                        </div>
                        <span class="text-sm text-gray-500">{{ $product->stock }} in stock</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Latest Products -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Latest Arrivals</h2>
            <p class="text-gray-600">Check out our newest products</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('images/products/'.$product->photopath) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @if($product->discounted_price)
                        <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            SALE
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('viewproduct', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($product->discounted_price)
                                <span class="font-bold text-blue-600">Rs. {{ number_format($product->discounted_price) }}</span>
                                <span class="text-gray-400 line-through text-sm">Rs. {{ number_format($product->price) }}</span>
                            @else
                                <span class="font-bold text-blue-600">Rs. {{ number_format($product->price) }}</span>
                            @endif
                        </div>
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                                <i class="fas fa-plus mr-1"></i>Add
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition inline-block">
                            <i class="fas fa-plus mr-1"></i>Add
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('products.all') }}" 
               class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                View All Products
            </a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shipping-fast text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Fast Delivery</h3>
                <p class="text-gray-600">Free shipping on orders over Rs. 1000</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Secure Payment</h3>
                <p class="text-gray-600">100% secure payment processing</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-undo text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Easy Returns</h3>
                <p class="text-gray-600">30-day return policy for all products</p>
            </div>
        </div>
    </div>
</div>
@endsection
