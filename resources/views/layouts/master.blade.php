<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Modern E-Commerce')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Ensure dropdowns work properly */
        .group:hover .group-hover\:opacity-100 {
            opacity: 1 !important;
        }
        .group:hover .group-hover\:visible {
            visibility: visible !important;
        }
        /* Fix dropdown positioning */
        .relative .absolute {
            position: absolute !important;
        }
        /* Force dropdown visibility on hover */
        .dropdown-container:hover .dropdown-menu {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            display: block !important;
        }
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            display: none;
        }
        /* Ensure z-index works properly - higher than navbar z-50 */
        .dropdown-container {
            position: relative;
        }
        .dropdown-menu {
            position: absolute !important;
            z-index: 9999 !important;
        }
        /* Override any conflicting z-index */
        .dropdown-container .dropdown-menu {
            z-index: 9999 !important;
        }
        /* Additional hover states */
        .dropdown-show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            display: block !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    @php
        $categories = \App\Models\Category::orderBy('order', 'asc')->get();
        $cartCount = auth()->check() ? auth()->user()->cart()->sum('quantity') : 0;
    @endphp

    <!-- Top Bar -->
    <div class="bg-gray-900 text-white py-3 px-4 border-b border-gray-700 relative z-60">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-sm">
            <!-- Left side - Contact info -->
            <div class="hidden md:flex items-center space-x-6">
                <div class="flex items-center space-x-2 text-gray-300">
                    <i class="fas fa-phone text-blue-400"></i>
                    <span>+977 98 12345678</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-300">
                    <i class="fas fa-envelope text-blue-400"></i>
                    <span>info@shophub.com</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-300">
                    <i class="fas fa-truck text-green-400"></i>
                    <span>Free shipping on orders Rs. 1000+</span>
                </div>
            </div>
            
            <!-- Right side - User menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button onclick="toggleDropdown('userMenu')" class="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 px-3 py-2 rounded-lg transition-colors duration-200">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/profiles/' . auth()->user()->profile_picture) }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     class="w-7 h-7 rounded-full object-cover border border-gray-600">
                            @else
                                <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="userMenu" class="absolute right-0 top-full mt-2 w-48 bg-gray-800 rounded-lg shadow-xl border border-gray-700 z-[9999] hidden">
                            <div class="py-2">
                                <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-white transition-colors">
                                    <i class="fas fa-user-circle text-blue-400 mr-3"></i>
                                    <span>My Profile</span>
                                </a>
                                <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-white transition-colors">
                                    <i class="fas fa-shopping-bag text-green-400 mr-3"></i>
                                    <span>My Orders</span>
                                </a>
                                <a href="{{ route('cart.index') }}" class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-white transition-colors">
                                    <i class="fas fa-shopping-cart text-purple-400 mr-3"></i>
                                    <span>Cart</span>
                                    @if($cartCount > 0)
                                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $cartCount }}</span>
                                    @endif
                                </a>
                                <hr class="my-2 border-gray-700">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-200 hover:bg-red-600 hover:text-white transition-colors">
                                        <i class="fas fa-sign-out-alt text-red-400 mr-3"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Sign Up</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white shadow-2xl sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="group flex items-center space-x-3 hover:scale-105 transition-all duration-300">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <i class="fas fa-gem text-white text-lg"></i>
                            </div>
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full opacity-80"></div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 bg-clip-text text-transparent">ShopHub</span>
                            <span class="text-xs text-gray-500 -mt-1">Premium Store</span>
                        </div>
                    </a>
                </div>

                <!-- Enhanced Search Bar -->
                <div class="flex-1 max-w-2xl mx-8 relative">
                    <form action="{{ route('search') }}" method="GET" class="relative group">
                        <div class="relative">
                            <input type="text" name="q" id="search-input" placeholder="Search for products, brands, categories..." 
                                   class="w-full px-6 py-3 pl-12 pr-20 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white group-hover:shadow-lg"
                                   value="{{ request('q') }}" autocomplete="off">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400 group-hover:text-blue-500 transition-all duration-300"></i>
                            </div>
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 flex items-center space-x-1 group">
                                <i class="fas fa-search group-hover:animate-pulse"></i>
                                <span class="text-sm font-medium hidden sm:block">Search</span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Enhanced Search Suggestions Dropdown -->
                    <div id="search-suggestions" class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-2xl shadow-2xl z-50 hidden backdrop-blur-sm">
                        <div id="suggestions-content" class="max-h-96 overflow-y-auto rounded-2xl">
                            <!-- Suggestions will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Enhanced Navigation Links -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 font-medium py-2 group">
                        <span>Home</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 group-hover:w-full transition-all duration-300"></div>
                    </a>
                    <a href="{{ route('products.all') }}" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 font-medium py-2 group">
                        <span>Products</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 group-hover:w-full transition-all duration-300"></div>
                    </a>
                    
                    <!-- Categories Dropdown -->
                    <div class="relative">
                        <button onclick="toggleDropdown('categoriesMenu')" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 font-medium flex items-center py-2">
                            <span>Categories</span>
                            <i class="fas fa-chevron-down ml-2 transition-transform duration-300"></i>
                        </button>
                        
                        <!-- Categories Dropdown Menu -->
                        <div id="categoriesMenu" class="absolute top-full left-0 mt-2 w-64 bg-gray-800 rounded-lg shadow-xl border border-gray-700 z-[9999] hidden">
                            <div class="py-2">
                                @foreach($categories as $category)
                                    @php
                                        $categoryConfig = [
                                            'Electronics' => ['icon' => 'fas fa-laptop', 'color' => 'text-blue-400'],
                                            'Clothing' => ['icon' => 'fas fa-tshirt', 'color' => 'text-purple-400'],
                                            'Books' => ['icon' => 'fas fa-book-open', 'color' => 'text-green-400'],
                                            'Home & Garden' => ['icon' => 'fas fa-home', 'color' => 'text-orange-400'],
                                            'Sports' => ['icon' => 'fas fa-dumbbell', 'color' => 'text-red-400'],
                                            'Beauty' => ['icon' => 'fas fa-spa', 'color' => 'text-pink-400'],
                                        ];
                                        $config = $categoryConfig[$category->name] ?? ['icon' => 'fas fa-tag', 'color' => 'text-blue-400'];
                                    @endphp
                                    <a href="{{ route('categoryproducts', $category->id) }}" 
                                       class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 hover:text-white transition-colors">
                                        <i class="{{ $config['icon'] }} {{ $config['color'] }} mr-3 text-lg"></i>
                                        <span class="font-medium">{{ $category->name }}</span>
                                        <i class="fas fa-arrow-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-gray-400"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Cart Icon with Animation -->
                    @auth
                        <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 p-2 group">
                            <div class="relative">
                                <i class="fas fa-shopping-cart text-xl"></i>
                                @if($cartCount > 0)
                                    <span class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse font-bold">{{ $cartCount }}</span>
                                @endif
                            </div>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-btn" class="p-2 text-gray-700 hover:text-blue-600 transition-all duration-300">
                        <div class="w-6 h-6 relative">
                            <span class="absolute top-0 left-0 w-full h-0.5 bg-current transition-all duration-300 transform origin-center"></span>
                            <span class="absolute top-2.5 left-0 w-full h-0.5 bg-current transition-all duration-300"></span>
                            <span class="absolute top-5 left-0 w-full h-0.5 bg-current transition-all duration-300 transform origin-center"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Enhanced Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-white border-t shadow-lg transform -translate-y-full transition-all duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-600 transition-all duration-200 rounded-xl">
                <i class="fas fa-home mr-3"></i>Home
            </a>
            <a href="{{ route('products.all') }}" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-600 transition-all duration-200 rounded-xl">
                <i class="fas fa-box mr-3"></i>Products
            </a>
            @if($cartCount > 0)
                <a href="{{ route('cart.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-600 transition-all duration-200 rounded-xl">
                    <i class="fas fa-shopping-cart mr-3"></i>Cart
                    <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $cartCount }}</span>
                </a>
            @endif
            <div class="border-t border-gray-200 pt-2 mt-2">
                <p class="px-4 py-2 text-sm font-medium text-gray-500 uppercase tracking-wide">Categories</p>
                @foreach($categories as $category)
                    @php
                        $categoryConfig = [
                            'Electronics' => ['icon' => 'fas fa-laptop', 'color' => 'text-blue-500'],
                            'Clothing' => ['icon' => 'fas fa-tshirt', 'color' => 'text-purple-500'],
                            'Books' => ['icon' => 'fas fa-book-open', 'color' => 'text-green-500'],
                            'Home & Garden' => ['icon' => 'fas fa-home', 'color' => 'text-orange-500'],
                            'Sports' => ['icon' => 'fas fa-dumbbell', 'color' => 'text-red-500'],
                            'Beauty' => ['icon' => 'fas fa-spa', 'color' => 'text-pink-500'],
                        ];
                        $config = $categoryConfig[$category->name] ?? ['icon' => 'fas fa-tag', 'color' => 'text-blue-500'];
                    @endphp
                    <a href="{{ route('categoryproducts', $category->id) }}" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 hover:text-blue-600 transition-all duration-200 rounded-xl">
                        <i class="{{ $config['icon'] }} {{ $config['color'] }} mr-3"></i>{{ $category->name }}
                    </a>
                @endforeach
            </div>
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
        // Simple and reliable dropdown toggle function
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const allDropdowns = document.querySelectorAll('[id$="Menu"]');
            
            // Close all other dropdowns
            allDropdowns.forEach(dd => {
                if (dd.id !== dropdownId) {
                    dd.classList.add('hidden');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('[id$="Menu"]');
            const isDropdownButton = event.target.closest('button[onclick*="toggleDropdown"]');
            
            if (!isDropdownButton) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });

        // Close dropdowns on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const dropdowns = document.querySelectorAll('[id$="Menu"]');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });

        // Enhanced Mobile menu toggle with animations
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const btn = this;
            const spans = btn.querySelectorAll('span');
            
            menu.classList.toggle('hidden');
            
            // Animate hamburger to X and back
            if (menu.classList.contains('hidden')) {
                // Reset to hamburger
                spans[0].style.transform = 'rotate(0deg) translateY(0)';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'rotate(0deg) translateY(0)';
                menu.style.transform = 'translateY(-100%)';
            } else {
                // Transform to X
                spans[0].style.transform = 'rotate(45deg) translateY(10px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translateY(-10px)';
                menu.style.transform = 'translateY(0)';
            }
        });

        // Enhanced search suggestions functionality
        const searchInput = document.getElementById('search-input');
        const suggestionsContainer = document.getElementById('search-suggestions');
        const suggestionsContent = document.getElementById('suggestions-content');
        let searchTimeout;

        if (searchInput) {
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

            // Enhanced focus effects for search
            searchInput.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500');
            });

            searchInput.addEventListener('blur', function() {
                setTimeout(() => {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500');
                }, 100);
            });

            // Hide suggestions on escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    suggestionsContainer.classList.add('hidden');
                }
            });
        }

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (searchInput && suggestionsContainer && !searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
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
                    <div class="p-6 text-center text-gray-500">
                        <i class="fas fa-search text-3xl mb-3 text-gray-300"></i>
                        <p class="font-medium">No products found</p>
                        <p class="text-sm">Try searching with different keywords</p>
                    </div>
                `;
            } else {
                suggestionsContent.innerHTML = suggestions.map(suggestion => `
                    <a href="${suggestion.url}" class="block p-4 hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 border-b border-gray-100 last:border-b-0 transition-all duration-200 group">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <img src="${suggestion.image}" alt="${suggestion.name}" class="w-14 h-14 object-cover rounded-xl shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 truncate">${suggestion.name}</h4>
                                <p class="text-sm text-gray-500 capitalize">${suggestion.category}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-lg font-bold text-blue-600">Rs. ${suggestion.price.toLocaleString()}</span>
                                    ${suggestion.discounted_price ? `<span class="text-sm text-gray-400 line-through">Rs. ${suggestion.original_price.toLocaleString()}</span>` : ''}
                                </div>
                            </div>
                            <i class="fas fa-arrow-right text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                        </div>
                    </a>
                `).join('');
            }
            
            suggestionsContainer.classList.remove('hidden');
        }

        // Add scroll effect to navbar
        let lastScrollTop = 0;
        const navbar = document.querySelector('nav');
        
        if (navbar) {
            window.addEventListener('scroll', function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    // Scrolling up
                    navbar.style.transform = 'translateY(0)';
                }
                
                // Add background blur when scrolling
                if (scrollTop > 50) {
                    navbar.classList.add('backdrop-blur-md', 'bg-white/95');
                    navbar.classList.remove('bg-white');
                } else {
                    navbar.classList.remove('backdrop-blur-md', 'bg-white/95');
                    navbar.classList.add('bg-white');
                }
                
                lastScrollTop = scrollTop;
            });
        }

        // Add loading animation to search button
        const searchButton = document.querySelector('form[action*="search"] button');
        if (searchButton) {
            searchButton.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.add('animate-spin');
                    
                    setTimeout(() => {
                        icon.classList.remove('animate-spin');
                    }, 1000);
                }
            });
        }
    </script>
</body>
</html>
