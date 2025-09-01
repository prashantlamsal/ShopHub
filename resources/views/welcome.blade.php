@extends('layouts.master')
@section('title', 'ShopHub - Your One-Stop Shopping Destination')

@section('content')
<!-- Hero Slider -->
<div class="relative h-screen overflow-hidden" id="heroSlider">
    <!-- Slide 1 -->
    <div class="slide absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 text-white transition-transform duration-700 ease-in-out">
        <div class="flex items-center justify-center h-full">
            <div class="max-w-7xl mx-auto px-4 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                            Discover Amazing Products
                        </h1>
                        <p class="text-xl mb-8 text-blue-100">
                            Shop the latest trends with unbeatable prices. Quality products delivered to your doorstep.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('products.all') }}" 
                               class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-center transform hover:scale-105">
                                Shop Now
                            </a>
                            <a href="#featured" 
                               class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition text-center transform hover:scale-105">
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
    </div>

    <!-- Slide 2 -->
    <div class="slide absolute inset-0 bg-gradient-to-r from-green-600 to-teal-600 text-white transition-transform duration-700 ease-in-out transform translate-x-full">
        <div class="flex items-center justify-center h-full">
            <div class="max-w-7xl mx-auto px-4 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                            Special Offers
                        </h1>
                        <p class="text-xl mb-8 text-green-100">
                            Up to 50% off on selected items. Limited time offer - don't miss out!
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('products.all') }}" 
                               class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-center transform hover:scale-105">
                                Shop Sale
                            </a>
                            <a href="#featured" 
                               class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition text-center transform hover:scale-105">
                                View Deals
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/10 rounded-2xl transform -rotate-3"></div>
                            <div class="relative bg-white/20 rounded-2xl p-8 backdrop-blur-sm">
                                <i class="fas fa-tags text-8xl text-white/80"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide 3 -->
    <div class="slide absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 text-white transition-transform duration-700 ease-in-out transform translate-x-full">
        <div class="flex items-center justify-center h-full">
            <div class="max-w-7xl mx-auto px-4 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                            Free Delivery
                        </h1>
                        <p class="text-xl mb-8 text-purple-100">
                            Free shipping on all orders above Rs. 1000. Fast and secure delivery to your doorstep.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('products.all') }}" 
                               class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-center transform hover:scale-105">
                                Order Now
                            </a>
                            <a href="#featured" 
                               class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition text-center transform hover:scale-105">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/10 rounded-2xl transform rotate-6"></div>
                            <div class="relative bg-white/20 rounded-2xl p-8 backdrop-blur-sm">
                                <i class="fas fa-shipping-fast text-8xl text-white/80"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button id="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 z-10 backdrop-blur-sm">
        <i class="fas fa-chevron-left text-xl"></i>
    </button>
    <button id="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 z-10 backdrop-blur-sm">
        <i class="fas fa-chevron-right text-xl"></i>
    </button>

    <!-- Slide Indicators -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
        <button class="slide-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300 active" data-slide="0"></button>
        <button class="slide-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300" data-slide="1"></button>
        <button class="slide-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300" data-slide="2"></button>
    </div>
</div>

<!-- Custom Styles and JavaScript -->
<style>
    .slide-indicator.active {
        background-color: white;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.style.transform = 'translateX(0)';
            } else if (i < index) {
                slide.style.transform = 'translateX(-100%)';
            } else {
                slide.style.transform = 'translateX(100%)';
            }
        });

        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    // Event listeners
    nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        nextSlide();
        startAutoSlide();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        prevSlide();
        startAutoSlide();
    });

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            stopAutoSlide();
            currentSlide = index;
            showSlide(currentSlide);
            startAutoSlide();
        });
    });

    // Pause auto-slide on hover
    const slider = document.getElementById('heroSlider');
    slider.addEventListener('mouseenter', stopAutoSlide);
    slider.addEventListener('mouseleave', startAutoSlide);

    // Start auto-slide
    startAutoSlide();
});
</script>

<!-- Categories Section -->
<div id="featured" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Shop by Category</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Explore our wide range of categories and find exactly what you're looking for.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            @php
                // Map category names to appropriate icons and colors
                $categoryConfig = [
                    'Electronics' => ['icon' => 'fas fa-laptop', 'bg' => 'bg-blue-100', 'hover_bg' => 'group-hover:bg-blue-200', 'icon_color' => 'text-blue-600'],
                    'Clothing' => ['icon' => 'fas fa-tshirt', 'bg' => 'bg-purple-100', 'hover_bg' => 'group-hover:bg-purple-200', 'icon_color' => 'text-purple-600'],
                    'Books' => ['icon' => 'fas fa-book-open', 'bg' => 'bg-green-100', 'hover_bg' => 'group-hover:bg-green-200', 'icon_color' => 'text-green-600'],
                    'Home & Garden' => ['icon' => 'fas fa-home', 'bg' => 'bg-orange-100', 'hover_bg' => 'group-hover:bg-orange-200', 'icon_color' => 'text-orange-600'],
                    'Sports' => ['icon' => 'fas fa-dumbbell', 'bg' => 'bg-red-100', 'hover_bg' => 'group-hover:bg-red-200', 'icon_color' => 'text-red-600'],
                    'Beauty' => ['icon' => 'fas fa-spa', 'bg' => 'bg-pink-100', 'hover_bg' => 'group-hover:bg-pink-200', 'icon_color' => 'text-pink-600'],
                ];
                
                // Get config for current category, fallback to default if not found
                $config = $categoryConfig[$category->name] ?? ['icon' => 'fas fa-tag', 'bg' => 'bg-blue-100', 'hover_bg' => 'group-hover:bg-blue-200', 'icon_color' => 'text-blue-600'];
            @endphp
            <a href="{{ route('categoryproducts', $category->id) }}" 
               class="group bg-gray-50 rounded-xl p-6 text-center hover:bg-blue-50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 {{ $config['bg'] }} rounded-full flex items-center justify-center mx-auto mb-4 {{ $config['hover_bg'] }} transition">
                    <i class="{{ $config['icon'] }} text-2xl {{ $config['icon_color'] }}"></i>
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
