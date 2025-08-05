@extends('layouts.master')
@section('title', 'Login - ShopHub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-shopping-bag text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
            <p class="mt-2 text-sm text-gray-600">
                Sign in to your account to continue shopping
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            @include('layouts.alert')
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Enter your email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Enter your password">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-blue-500 group-hover:text-blue-400"></i>
                        </span>
                        Sign in
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                            Sign up here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Features -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Why ShopHub?</h3>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shipping-fast text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Free Delivery</p>
                        <p class="text-sm text-gray-500">On orders over Rs. 1000</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Secure Shopping</p>
                        <p class="text-sm text-gray-500">100% secure payment</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-undo text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Easy Returns</p>
                        <p class="text-sm text-gray-500">30-day return policy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
