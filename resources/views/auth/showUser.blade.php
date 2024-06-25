@extends('layouts.default')
@section('title', 'Details')
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

                </ul>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="container mx-auto">
                <div class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto">
                    <div class="text-center mb-4">
                        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    </div>
                    <div class="mb-4">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    <div class="mb-4">
                        <p><strong>Status</strong> {{ $user->status }}</p> 
                    </div>
                    <div class="mb-4">
                        <p><strong>Location:</strong> {{ $user->location }}</p>
                    </div>
                    <div class="mb-4">
                @if ($user->image)

                    <img src="/storage/images/{{$user->image}}" alt="User Image" class="rounded-full h-32 w-32 mx-auto">
                @else
                    <p>No image available</p>
                @endif
            </div>
                    <div class="text-center">
                        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Users</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            &copy; 2024 AdminLTE
        </div>
    </footer>
</div>

@endsection
