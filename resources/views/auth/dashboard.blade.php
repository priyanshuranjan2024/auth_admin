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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold mb-2 text-gray-700">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalUsersCount }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold mb-2 text-gray-700">Active Users</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $activeUsersCount }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold mb-2 text-gray-700">Inactive Users</h3>
                    <p class="text-3xl font-bold text-red-600">{{ $inactiveUsersCount }}</p>
                </div>
            </div>

            <div class="mb-6 flex justify-center">
    <form action="{{ route('search_data') }}" method="GET" class="flex w-full">
        <!-- Search by Name -->
        <input type="text" name="search_name" value="{{ request('search_name') }}"
            placeholder="Search by Name"
            class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none">

        <!-- Search by Email -->
        <input type="text" name="search_email" value="{{ request('search_email') }}"
            placeholder="Search by Email"
            class="w-full px-4 py-2 border border-gray-300 focus:outline-none">

        <!-- Search by Location -->
        <input type="text" name="search_location" value="{{ request('search_location') }}"
            placeholder="Search by Location"
            class="w-full px-4 py-2 border border-gray-300 rounded-r-md focus:outline-none">

        <!-- Status Filter -->
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-r-md focus:outline-none">
            <option value="">Select Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <!-- Search Button -->
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md">Search</button>
    </form>
</div>


            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border cursor-pointer"><a
                                    href="{{ route('dashboard', ['sort' => 'name', 'order' => ($sort == 'name' && $order == 'asc') ? 'desc' : 'asc']) }}">Name
                                    <span id="nameSortIcon" class="ml-1 sort-icon"></span></a></th>
                            <th class="px-4 py-2 border cursor-pointer"><a
                                    href="{{ route('dashboard', ['sort' => 'email', 'order' => ($sort == 'email' && $order == 'asc') ? 'desc' : 'asc']) }}">Email
                                    <span id="emailSortIcon" class="ml-1 sort-icon"></span></a></th>
                            <th class="px-4 py-2 border cursor-pointer"><a
                                    href="{{ route('dashboard', ['sort' => 'location', 'order' => ($sort == 'location' && $order == 'asc') ? 'desc' : 'asc']) }}">Location
                                    <span id="locationSortIcon" class="ml-1 sort-icon"></span></a></th>
                            <th class="px-4 py-2 border"><a
                                    href="{{ route('dashboard', ['sort' => 'status', 'order' => ($sort == 'status' && $order == 'asc') ? 'desc' : 'asc']) }}">Status
                                    <span id="locationSortIcon" class="ml-1 sort-icon"></span></a></th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">{{ $user->location }}</td>
                            <td class="px-4 py-2 border">
    <form action="{{ route('toggleStatus', $user->id) }}" method="GET" style="display: inline;">
        @csrf
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
            {{ $user->status }}
        </button>
    </form>
</td>
                            <td class="px-4 py-2 border">
                                <div class="action-buttons">
                                <a href="{{ route('user.show', $user->id) }}">
                        <button class="px-2 py-1 bg-blue-500 text-white rounded-md">View</button>
                    </a>
                                    <a href="edit_user/{{$user->id}}">
                                        <button class="px-2 py-1 bg-yellow-500 text-white rounded-md">Update</button>
                                    </a>
                                    <a href="delete_user/{{$user->id}}">
                                        <button class="px-2 py-1 bg-red-500 text-white rounded-md">Delete</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {{$users->links()}}


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
// Function to confirm status change
function confirmStatusChange(event, currentStatus) {
    event.preventDefault(); // Prevent the default action (navigation)
    let newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    if (confirm(`Are you sure you want to change the status to ${newStatus}?`)) {
        window.location.href = event.target.closest('a').href; // Navigate to the link if confirmed
    }
}
</script>
@endsection