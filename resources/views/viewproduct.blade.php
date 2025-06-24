@extends('layouts.master')
@section('content')
    <div class="px-20 py-10">
        <div class="mt-5">
            <div class="grid grid-cols-5">
                <img src="{{asset('images/products/'.$product->photopath)}}" alt="Product Image" class="w-full h-auto col-span-2 object-cover mb-4 md:mb-0">
                <div class="col-span-2 border-x-2 px-2 mx-2">
                    <h3 class="font-semibold text-xl">{{$product->name}}</h3>
                    <p class="text-gray-600 mt-2">
                        @if($product->discounted_price != '')
                        <span class="text-lg font-bold">Rs. {{$product->discounted_price}}</span>
                        <span class="text-red-500 line-through text-sm ml-2">Rs. {{$product->price}}</span>
                        @else
                        <span class="text-lg font-bold">Rs. {{$product->price}}</span>
                        @endif
                    </p>
                    <p class="text-gray-500 text-sm">In Stock: {{$product->stock}}</p>
                    <div class="flex items-center mt-4">
                        <button class="bg-gray-200 w-8 h-8" onclick="decrement()">-</button>
                        <input type="text" value="1" class="w-12 h-8 text-center border rounded" id="quantity" readonly>
                        <button class="bg-gray-200 w-8 h-8" onclick="increment()">+</button>
                    </div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded mt-4 hover:bg-blue-700 transition duration-300">
                        Add to Cart
                    </button>
                </div>
                <div>
                    <p>Free Delivery</p>
                    <p>24/7 Support</p>
                    <p>Easy Return</p>
                </div>
            </div>
        </div>
    </div>
@endsection
