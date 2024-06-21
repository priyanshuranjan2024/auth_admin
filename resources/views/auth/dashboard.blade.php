@extends('layouts.default')
@section('title', 'Dashboard')
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

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">AdminLTE - Dashboard</h2>
            <div class="mb-6 flex justify-center">
            <form action="search_data" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search users..." class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md">Search</button>
                </form>
            </div>
            <div class="mb-4 text-center">
                <h3 class="text-xl font-semibold">Total Users: {{ $users->count() }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border cursor-pointer">Name <span
                                    id="nameSortIcon" class="ml-1 sort-icon"></span></th>
                            <th class="px-4 py-2 border cursor-pointer">Email <span
                                    id="emailSortIcon" class="ml-1 sort-icon"></span></th>
                            <th class="px-4 py-2 border">Location</th>
                            <th class="px-4 py-2 border">Actions</th>
                                
                            
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- Paginate the users here -->
                        @php
                        $perPage = 10;
                        $pages = ceil($users->count() / $perPage);
                        @endphp
                        @foreach ($users as $user)
                        <tr class="text-center">
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">{{ $user->location }}</td>
                            <td class="px-4 py-2 border">
                                <a href=""><button class="px-2 py-1 bg-yellow-500 text-white rounded-md mr-2">Update</button></a>
                                <a href="delete_user/{{$user->id}}"><button class="px-2 py-1 bg-red-500 text-white rounded-md" onclick="">Delete</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination controls -->
                <div class="mt-4 ">
                    @for ($i = 1; $i <= $pages; $i++)
                        <button class="px-3 py-1 bg-gray-300 mr-2 rounded-full" onclick="changePage({{ $i }})">{{ $i }}</button>
                    @endfor
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

<script>
let currentPage = 1;
// Function to change current page
function changePage(pageNumber) {
    currentPage = pageNumber;
    let startIndex = (currentPage - 1) * {{ $perPage }};
    let endIndex = startIndex + {{ $perPage }} - 1;
    let tableRows = document.querySelectorAll('#userTableBody tr');

    tableRows.forEach((row, index) => {
        if (index >= startIndex && index <= endIndex) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}

// Function to initialize pagination on page load
document.addEventListener('DOMContentLoaded', function() {
    // Get the current page from the URL query parameter or use 1 as default
    let urlParams = new URLSearchParams(window.location.search);
    currentPage = parseInt(urlParams.get('page')) || 1;
    
    // Trigger the changePage function with the current page
    changePage(currentPage);
});
</script>


@endsection
