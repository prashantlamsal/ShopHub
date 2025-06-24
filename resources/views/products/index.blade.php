@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header with Add Product button -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Product Inventory</h1>
        <a href="{{route('products.create')}}" class="bg-amber-600 hover:bg-amber-700 px-4 py-2 rounded-md text-white font-medium flex items-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Product
        </a>
    </div>

    <!-- Product Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pricing</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <!-- Product Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-md overflow-hidden border border-gray-200">
                                    <img class="h-full w-full object-cover" src="{{asset('images/products/'.$product->photopath)}}" alt="{{$product->name}}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{$product->name}}</div>
                                    <div class="text-sm text-gray-500 line-clamp-1">{{$product->description}}</div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Pricing -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <span class="{{ $product->discounted_price ? 'line-through text-gray-400' : 'font-medium' }}">${{ number_format($product->price, 2) }}</span>
                                @if($product->discounted_price)
                                <span class="ml-2 font-medium text-green-600">${{ number_format($product->discounted_price, 2) }}</span>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Stock -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 
                                   ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $product->stock }} {{ $product->stock == 1 ? 'item' : 'items' }}
                            </span>
                        </td>
                        
                        <!-- Category -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                {{$product->category->name}}
                            </span>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Empty State -->
    @if($products->isEmpty())
    <div class="bg-white rounded-lg shadow p-8 text-center mt-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No products found</h3>
        <p class="mt-1 text-sm text-gray-500">Get started by adding your first product</p>
        <div class="mt-6">
            <a href="{{route('products.create')}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Product
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
{{-- @extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="flex justify-end mb-4">
        <a href="{{route('products.create')}}" class="bg-amber-600 px-2 py-1 rounded text-white">Add Product</a>
    </div>

    <table class="w-full">
        <tr class="bg-gray-200">
            <th class="p-2 border border-gray-300">Picture</th>
            <th class="p-2 border border-gray-300">Product Name</th>
            <th class="p-2 border border-gray-300">Price</th>
            <th class="p-2 border border-gray-300">Discounted Price</th>
            <th class="p-2 border border-gray-300">Description</th>
            <th class="p-2 border border-gray-300">Stock</th>
            <th class="p-2 border border-gray-300">Category</th>
            <th class="p-2 border border-gray-300">Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td class="p-2 border">
                <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="h-16  transition-all duration-300">
            </td>
            <td class="p-2 border">{{$product->name}}</td>
            <td class="p-2 border">{{$product->price}}</td>
            <td class="p-2 border">{{$product->discounted_price ?? '--'}}</td>
            <td class="p-2 border">{{$product->description}}</td>
            <td class="p-2 border">{{$product->stock}}</td>
            <td class="p-2 border">{{$product->category->name}}</td>
            <td class="p-2 border text-center">
                <a href="{{route('products.edit',$product->id)}}" class="bg-blue-600 px-2 py-1 rounded text-white">Edit</a>
                <a href="{{route('products.destroy',$product->id)}}" onclick="return confirm('Are you sure to Delete?')" class="bg-red-600 px-2 py-1 rounded text-white">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection --}}
