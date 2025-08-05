@extends('layouts.master')
@section('title', $product->name . ' - ShopHub')

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
                    <a href="{{ route('categoryproducts', $product->category->id) }}" class="text-gray-700 hover:text-blue-600">
                        {{ $product->category->name }}
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Product Image -->
        <div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/products/'.$product->photopath) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover">
            </div>
        </div>

        <!-- Product Details -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                
                <!-- Rating -->
                <div class="flex items-center mb-4">
                    <div class="flex items-center text-yellow-400 mr-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $product->average_rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <span class="text-gray-600">({{ $product->reviews_count }} reviews)</span>
                </div>

                <!-- Price -->
                <div class="mb-6">
                    @if($product->discounted_price)
                        <div class="flex items-center space-x-4">
                            <span class="text-3xl font-bold text-blue-600">Rs. {{ number_format($product->discounted_price) }}</span>
                            <span class="text-xl text-gray-400 line-through">Rs. {{ number_format($product->price) }}</span>
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                {{ round((($product->price - $product->discounted_price) / $product->price) * 100) }}% OFF
                            </span>
                        </div>
                    @else
                        <span class="text-3xl font-bold text-blue-600">Rs. {{ number_format($product->price) }}</span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock > 0)
                        <span class="text-green-600 font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="text-red-600 font-semibold">
                            <i class="fas fa-times-circle mr-1"></i>Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Add to Cart -->
                @if($product->stock > 0)
                    @auth
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" onclick="decrementQuantity()" class="px-3 py-2 text-gray-600 hover:text-gray-800">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-16 text-center border-0 focus:ring-0">
                                <button type="button" onclick="incrementQuantity()" class="px-3 py-2 text-gray-600 hover:text-gray-800">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition">
                            <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                        </button>
                    </form>
                    @else
                    <div class="mb-6">
                        <a href="{{ route('login') }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition text-center block">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login to Add to Cart
                        </a>
                    </div>
                    @endauth
                @endif

                <!-- Features -->
                <div class="border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <i class="fas fa-shipping-fast text-2xl text-blue-600 mb-2"></i>
                            <p class="text-sm text-gray-600">Free Delivery</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-headset text-2xl text-blue-600 mb-2"></i>
                            <p class="text-sm text-gray-600">24/7 Support</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-undo text-2xl text-blue-600 mb-2"></i>
                            <p class="text-sm text-gray-600">Easy Return</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Customer Reviews</h2>
            
            @auth
            <!-- Add Review Form -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Write a Review</h3>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <div class="flex items-center space-x-2">
                            @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" class="hidden">
                            <label for="rating{{ $i }}" class="text-2xl text-gray-300 hover:text-yellow-400 cursor-pointer">
                                <i class="fas fa-star"></i>
                            </label>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Comment (Optional)</label>
                        <textarea name="comment" id="comment" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Share your experience with this product"></textarea>
                    </div>
                    
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Submit Review
                    </button>
                </form>
            </div>
            @endauth

            <!-- Reviews List -->
            <div class="space-y-6">
                @forelse($product->reviews as $review)
                <div class="border-b pb-6 last:border-b-0">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                            <div class="flex items-center text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>
                    @if($review->comment)
                        <p class="text-gray-600">{{ $review->comment }}</p>
                    @endif
                </div>
                @empty
                <div class="text-center py-8">
                    <p class="text-gray-500">No reviews yet. Be the first to review this product!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                <a href="{{ route('viewproduct', $relatedProduct->id) }}">
                    <img src="{{ asset('images/products/'.$relatedProduct->photopath) }}" 
                         alt="{{ $relatedProduct->name }}" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                </a>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('viewproduct', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a>
                    </h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($relatedProduct->discounted_price)
                                <span class="font-bold text-blue-600">Rs. {{ number_format($relatedProduct->discounted_price) }}</span>
                                <span class="text-gray-400 line-through text-sm">Rs. {{ number_format($relatedProduct->price) }}</span>
                            @else
                                <span class="font-bold text-blue-600">Rs. {{ number_format($relatedProduct->price) }}</span>
                            @endif
                        </div>
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
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
    </div>
    @endif
</div>

<script>
function incrementQuantity() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.getAttribute('max'));
    const currentValue = parseInt(input.value);
    if (currentValue < max) {
        input.value = currentValue + 1;
    }
}

function decrementQuantity() {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
    }
}

// Star rating functionality
document.querySelectorAll('input[name="rating"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const rating = this.value;
        document.querySelectorAll('label[for^="rating"] i').forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    });
});
</script>
@endsection
