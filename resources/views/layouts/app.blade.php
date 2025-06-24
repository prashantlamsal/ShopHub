<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .sidebar-link.active {
                background-color: rgba(255, 255, 255, 0.1);
                border-left: 4px solid white;
            }
            .sidebar-link:hover:not(.active) {
                background-color: rgba(255, 255, 255, 0.05);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        @include('layouts.alert')
        
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="w-64 bg-gradient-to-b from-amber-600 to-amber-700 text-white shadow-lg">
                <div class="flex items-center justify-center py-6 px-4">
                    {{-- <img src="{{asset('')}}" alt="Logo" class="h-10"> --}}
                     <div class="flex items-center gap-4">
                        <span class="text-4xl font-medium text-white drop-shadow-[0_2px_1px_rgba(0,0,0,0.15)]">हाम्रो बजार</span>
  
  
                        </div>
                    
                 </div>

                <nav class="mt-6">
                    
                    
                    <ul>
                        <li>
                            <a href="/dashboard" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-white transition-colors duration-200">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('categories.index')}}" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-white transition-colors duration-200">
                                <i class="fas fa-tags mr-3"></i>
                                <span class="font-medium">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('products.index')}}" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-white transition-colors duration-200">
                                <i class="fas fa-box-open mr-3"></i>
                                <span class="font-medium">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-white transition-colors duration-200">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                <span class="font-medium">Orders</span>
                                <span class="ml-auto bg-amber-500 text-white text-xs font-bold px-2 py-1 rounded-full">15</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-white transition-colors duration-200">
                                <i class="fas fa-users mr-3"></i>
                                <span class="font-medium">Users</span>
                            </a>
                        </li>
                        <li class="mt-8 border-t border-amber-500 pt-4">
                            <a href="" class="sidebar-link flex items-center py-3 px-6 text-white hover:text-white transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span class="font-medium">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Navigation -->
                <header class="bg-white shadow-sm">
                    <div class="flex items-center justify-between px-6 py-4">
                        <h1 class="text-2xl font-bold text-gray-800">@yield('title')</h1>
                        
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-bell text-xl"></i>
                                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                                </button>
                            </div>
                            
                            <div class="relative">
                                <button class="flex items-center focus:outline-none">
                                    <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin&background=ff9900&color=fff" alt="User">
                                    <span class="ml-2 text-gray-700 font-medium">Admin</span>
                                    <i class="fas fa-chevron-down ml-1 text-gray-500"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                                <p class="text-sm text-gray-500">Overview and statistics</p>
                            </div>
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i> Add New
                                </button>
                            </div>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-amber-500 to-amber-300 rounded-full mt-2"></div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6">
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
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.alert')
        <div class="flex bg-gray-100">
            <div class="w-52 bg-amber-500 text-white h-screen">
                <img src="{{asset('logo.png')}}" alt="" class="my-4 mx-auto">
                <div class="mt-4">
                    <a href="/dashboard" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Dashboard</a>
                    <a href="{{route('categories.index')}}" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Categories</a>
                    <a href="{{route('products.index')}}" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Products</a>
                    <a href="" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Orders</a>
                    <a href="" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Users</a>
                    <form action="{{route('logout')}}" method="POST" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">
                        @csrf
                        <button type="submit" class="w-full text-left">Logout</button>
                    </form>
                </div>
            </div>
            <div class="flex-1 p-4">
                <h1 class="font-bold text-2xl">@yield('title')</h1>
                <hr class="h-1 bg-blue-500 mb-4">
                <div class="bg-white rounded-lg shadow p-4">@yield('content')</div>
            </div>
        </div>
    </body>
</html> --}}
