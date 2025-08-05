<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Modern E-Commerce')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @php
        $categories = \App\Models\Category::orderBy('order', 'asc')->get();
        $cartCount = auth()->check() ? auth()->user()->cart()->sum('quantity') : 0;
    @endphp

    <!-- Top Bar -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-2 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-sm">
            <div class="flex items-center space-x-4">
                <span><i class="fas fa-phone mr-1"></i> +1 234 567 890</span>
                <span><i class="fas fa-envelope mr-1"></i> info@ecommerce.com</span>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative group">
                        <span class="flex items-center cursor-pointer">
                            <i class="fas fa-user mr-1"></i> Hi, {{ auth()->user()->name }}
                            <i class="fas fa-chevron-down ml-1"></i>
                        </span>
                        <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[60]">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="fas fa-user mr-2"></i> My Profile
                            </a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="fas fa-shopping-bag mr-2"></i> My Orders
                            </a>
                            <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="fas fa-shopping-cart mr-2"></i> Cart
                                @if($cartCount > 0)
                                    <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $cartCount }}</span>
                                @endif
                            </a>
                            <div class="border-t border-gray-200">
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                        <i class="fas fa-shopping-bag mr-2"></i>ShopHub
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-8 relative">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="q" id="search-input" placeholder="Search products..." 
                               class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               value="{{ request('q') }}" autocomplete="off">
                        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Search Suggestions Dropdown -->
                    <div id="search-suggestions" class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden">
                        <div id="suggestions-content" class="max-h-96 overflow-y-auto">
                            <!-- Suggestions will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">Home</a>
                    <a href="{{ route('products.all') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">Products</a>
                    
                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 transition font-medium flex items-center">
                            Categories <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[60]">
                            @foreach($categories as $category)
                                <a href="{{ route('categoryproducts', $category->id) }}" 
                                   class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Button -->
    <div class="md:hidden bg-white border-t">
        <button id="mobile-menu-btn" class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50">
            <i class="fas fa-bars mr-2"></i> Menu
        </button>
        <div id="mobile-menu" class="hidden bg-white border-t">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Home</a>
            <a href="{{ route('products.all') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Products</a>
            @foreach($categories as $category)
                <a href="{{ route('categoryproducts', $category->id) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @include('layouts.alert')
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">ShopHub</h3>
                    <p class="text-gray-300">Your one-stop destination for quality products at great prices.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('products.all') }}" class="text-gray-300 hover:text-white transition">Products</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Returns</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Size Guide</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-300 mb-4">Subscribe to get special offers and updates.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="flex-1 px-3 py-2 rounded-l-lg text-gray-800 focus:outline-none">
                        <button type="submit" class="bg-blue-600 px-4 py-2 rounded-r-lg hover:bg-blue-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2025 ShopHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Search suggestions functionality
        const searchInput = document.getElementById('search-input');
        const suggestionsContainer = document.getElementById('search-suggestions');
        const suggestionsContent = document.getElementById('suggestions-content');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            // Hide suggestions if query is too short
            if (query.length < 2) {
                suggestionsContainer.classList.add('hidden');
                return;
            }

            // Set timeout to avoid too many requests
            searchTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.classList.add('hidden');
            }
        });

        // Hide suggestions on escape key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                suggestionsContainer.classList.add('hidden');
            }
        });

        function fetchSuggestions(query) {
            fetch(`/search-suggestions?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(suggestions => {
                    displaySuggestions(suggestions);
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                });
        }

        function displaySuggestions(suggestions) {
            if (suggestions.length === 0) {
                suggestionsContent.innerHTML = `
                    <div class="p-4 text-center text-gray-500">
                        <i class="fas fa-search text-2xl mb-2"></i>
                        <p>No products found</p>
                    </div>
                `;
            } else {
                suggestionsContent.innerHTML = suggestions.map(suggestion => `
                    <a href="${suggestion.url}" class="block p-3 hover:bg-gray-50 border-b border-gray-100 last:border-b-0 transition">
                        <div class="flex items-center space-x-3">
                            <img src="${suggestion.image}" alt="${suggestion.name}" class="w-12 h-12 object-cover rounded">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">${suggestion.name}</h4>
                                <p class="text-sm text-gray-500">${suggestion.category}</p>
                                <p class="text-sm font-semibold text-blue-600">Rs. ${suggestion.price.toLocaleString()}</p>
                            </div>
                        </div>
                    </a>
                `).join('');
            }
            
            suggestionsContainer.classList.remove('hidden');
        }
    </script>
</body>
</html>
