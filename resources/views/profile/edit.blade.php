@extends('layouts.master')
@section('title', 'Edit Profile - ShopHub')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('profile.show') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Profile
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b bg-gray-50">
            <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
            <p class="text-gray-600">Update your personal information and profile picture</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')

            <!-- Profile Picture Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Picture</h3>
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/profiles/' . $user->profile_picture) }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-24 h-24 rounded-full object-cover border-4 border-blue-100">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-2xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload New Picture</label>
                        <input type="file" name="profile_picture" accept="image/*" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Max size: 2MB. Supported formats: JPEG, PNG, GIF, WebP</p>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('date_of_birth')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea name="address" rows="3" placeholder="Enter your full address..."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-2">About Me</label>
                <textarea name="bio" rows="4" placeholder="Tell us a bit about yourself..."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
                <a href="{{ route('profile.show') }}" 
                   class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Password Change Section -->
    <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800">Change Password</h2>
            <p class="text-gray-600">Update your password to keep your account secure</p>
        </div>
        
        <form action="{{ route('password.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                    <input type="password" name="current_password" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-key mr-2"></i>Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

