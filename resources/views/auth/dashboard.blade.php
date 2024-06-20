@extends('layouts.default')
@section('title', 'Dashboard')
@section('content')
<!-- Top Navbar -->
<nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">Admin LTE</div>
            <div>
                <a href="{{ route('logout') }}" class="text-white">Sign Out</a>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Side Navbar -->
        <aside class="w-64 bg-gray-800 text-white p-4">
            <h2 class="text-xl font-bold mb-4">Menu</h2>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">AdminLTE - Dashboard</h2>
            <div class="mb-4 text-center">
                <h3 class="text-xl font-semibold">Total Users: {{ $users->count() }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td class="px-4 py-2 border">{{ $user->name }}</td>
                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                <td class="px-4 py-2 border">{{ $user->location }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>


@endsection