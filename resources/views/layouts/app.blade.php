<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ShopHub Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .sidebar-link.active {
                background: linear-gradient(90deg, #fbbf24 0%, #f59e42 100%);
                color: #fff !important;
                border-left: 4px solid #2563eb;
            }
            .sidebar-link:hover:not(.active) {
                background-color: rgba(255, 255, 255, 0.08);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        @include('layouts.alert')
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white shadow-xl flex flex-col">
                <div class="flex items-center justify-center py-8 px-4 border-b border-blue-800">
                    <a href="/dashboard" class="flex items-center gap-3">
                        <span class="bg-white rounded-full p-2 shadow">
                            <i class="fas fa-store text-blue-700 text-2xl"></i>
                        </span>
                        <span class="text-2xl font-bold tracking-wide text-white">ShopHub</span>
                    </a>
                </div>
                <nav class="flex-1 mt-6">
                    <ul class="space-y-1">
                        <li>
                            <a href="/dashboard" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-blue-200 transition-colors duration-200">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('categories.index')}}" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-blue-200 transition-colors duration-200">
                                <i class="fas fa-tags mr-3"></i>
                                <span class="font-medium">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('products.index')}}" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-blue-200 transition-colors duration-200">
                                <i class="fas fa-box-open mr-3"></i>
                                <span class="font-medium">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-blue-200 transition-colors duration-200">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                <span class="font-medium">Orders</span>
                                <span class="ml-auto bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ App\Models\Order::where('status', 'pending')->count() }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-blue-200 transition-colors duration-200">
                                <i class="fas fa-users mr-3"></i>
                                <span class="font-medium">Users</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="mt-auto border-t border-blue-800 p-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-800 hover:bg-blue-700 text-white font-medium transition">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Navigation -->
                <header class="bg-white shadow-sm sticky top-0 z-40">
                    <div class="flex items-center justify-between px-8 py-4">
                        <h1 class="text-2xl font-bold text-blue-900 tracking-wide">@yield('title')</h1>
                        <div class="flex items-center space-x-4">
                            <button class="text-gray-500 hover:text-blue-700 focus:outline-none relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                            <div class="flex items-center gap-2 bg-blue-100 px-3 py-1 rounded-lg">
                                <img class="h-8 w-8 rounded-full object-cover border-2 border-blue-700" src="https://ui-avatars.com/api/?name=Admin&background=2563eb&color=fff" alt="User">
                                <span class="ml-2 text-blue-900 font-medium">Admin</span>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-blue-900">@yield('title')</h2>
                                <p class="text-sm text-gray-500">Overview and statistics</p>
                            </div>
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800 transition-colors">
                                    <i class="fas fa-plus mr-2"></i> Add New
                                </button>
                            </div>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-300 rounded-full mt-2"></div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        <script>
            // Add active class to current page link
            document.addEventListener('DOMContentLoaded', function() {
                const currentUrl = window.location.pathname;
                const links = document.querySelectorAll('.sidebar-link');
                links.forEach(link => {
                    if (link.getAttribute('href') === currentUrl) {
                        link.classList.add('active');
                    }
                });
            });
        </script>
    </body>
</html>
