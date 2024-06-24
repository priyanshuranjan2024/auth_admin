@extends('layouts.default')

@section('title', 'Edit User')

@section('content')

<div class="flex flex-col min-h-screen">
    <!-- Top Navbar -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">Admin LTE</div>
            <div>
                <a href="{{ route('logout') }}" class="text-white">Sign Out</a>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">
        <!-- Side Navbar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-xl font-bold mb-4">Menu</h2>
                <!-- Sidebar links -->
                <ul>
                    <li><a href="#" class="block text-white hover:bg-gray-700 px-4 py-2">Dashboard</a></li>
                    <li><a href="#" class="block text-white hover:bg-gray-700 px-4 py-2">Users</a></li>
                    <li><a href="#" class="block text-white hover:bg-gray-700 px-4 py-2">Settings</a></li>
                    <!-- Add more sidebar links as needed -->
                </ul>
            </div>
        </aside>
        <main class="flex-1 p-8">
            <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center">Edit User Information</h2>

@if(session('success'))
<div class="bg-green-500 text-white p-4 mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-500 text-white p-4 mb-4">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('update_data', $data->id) }}" method="POST" class="max-w-lg mx-auto">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Name</label>
        <input type="text" name="name" id="name" value="{{ $data->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ $data->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" readonly>
    </div>
    <div class="mb-4">
        <label for="location" class="block text-gray-700">Location</label>
        <input type="text" name="location" id="location" value="{{ $data->location }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>
    <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        <small class="text-gray-600">Leave blank to keep the current password</small>
    </div>
    <div class="mb-4 text-center">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
    </div>
</form>
</div>
            </div>
                
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-auto w-full">
        <div class="container mx-auto text-center">
            &copy; 2024 AdminLTE
        </div>
    </footer>
</div>

@endsection
