@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Overview</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Category Card -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Categories</h2>
                        <p class="text-3xl font-bold text-gray-800">{{$totalcategories}}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Product Card -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Products</h2>
                        <p class="text-3xl font-bold text-gray-800">55</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Order Card -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Orders</h2>
                        <p class="text-3xl font-bold text-gray-800">120</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Status</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Pending Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Pending Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">44</p>
            </div>

            <!-- Processing Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-blue-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Processing Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">55</p>
            </div>

            <!-- Delivered Orders -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-green-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Delivered Orders</h3>
                </div>
                <p class="text-3xl font-bold text-gray-800 ml-12">120</p>
            </div>
        </div>
    </div>
@endsection
{{-- 

@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Total Categories</h2>
            <p class="text-3xl font-bold">{{$totalcategories}}</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Total Products</h2>
            <p class="text-3xl font-bold">55</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Total Orders</h2>
            <p class="text-3xl font-bold">120</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Pending Orders</h2>
            <p class="text-3xl font-bold">44</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Processing Orders</h2>
            <p class="text-3xl font-bold">55</p>
        </div>
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Delivered Orders</h2>
            <p class="text-3xl font-bold">120</p>
        </div>
    </div>

    </div>
@endsection --}}
