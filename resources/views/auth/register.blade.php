@extends('layouts.master')
@section('title', 'Register - ShopHub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Create your account</h2>
            <p class="mt-2 text-sm text-gray-600">
                Join ShopHub and start shopping today
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            @include('layouts.alert')
            
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" id="name" required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Enter your full name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                               placeholder="Create a password">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Confirm your password">
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" required
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the 
                        <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a> 
                        and 
                        <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
                    </label>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus text-blue-500 group-hover:text-blue-400"></i>
                        </span>
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Benefits -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Join ShopHub Today</h3>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-gift text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Welcome Bonus</p>
                        <p class="text-sm text-gray-500">Get 10% off your first order</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-bell text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Exclusive Offers</p>
                        <p class="text-sm text-gray-500">Be the first to know about sales</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-heart text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Wishlist</p>
                        <p class="text-sm text-gray-500">Save your favorite products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
