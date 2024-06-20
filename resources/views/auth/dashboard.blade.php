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
            <div class="mb-4 text-center">
                <h3 class="text-xl font-semibold">Total Users: {{ $users->count() }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border cursor-pointer" onclick="sortTable('name')">Name <span
                                    id="nameSortIcon" class="ml-1 sort-icon"></span></th>
                            <th class="px-4 py-2 border cursor-pointer" onclick="sortTable('email')">Email <span
                                    id="emailSortIcon" class="ml-1 sort-icon"></span></th>
                            <th class="px-4 py-2 border">Location</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            &copy; 2024 AdminLTE
        </div>
    </footer>
</div>

<script>
// Function to compare values
function compareValues(value1, value2) {
    if (value1 < value2) {
        return -1;
    }
    if (value1 > value2) {
        return 1;
    }
    return 0;
}

// Function to reset all sort icons
function resetSortIcons() {
    const sortIcons = document.querySelectorAll('.sort-icon');
    sortIcons.forEach(icon => icon.innerHTML = '');
}

// Function to get column index based on column name
function getColumnIndex(columnName) {
    switch (columnName) {
        case 'name':
            return 0;
        case 'email':
            return 1;

        default:
            return 0;
    }
}

// Function to sort table by column name
function sortTable(columnName) {
    let table, rows, switching, i, x, y, shouldSwitch;
    table = document.querySelector('.table-auto');
    switching = true;

    // Set the sorting direction to ascending by default
    let sortDirection = 'asc';
    let sortIcon = document.getElementById(columnName + 'SortIcon');

    // Check the current sort direction and toggle
    if (sortIcon.innerHTML === '↑') {
        sortDirection = 'desc';
    }

    // Loop until no switching has been done
    while (switching) {
        switching = false;
        rows = table.rows;

        // Loop through all table rows except the header
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            // Get the two elements you want to compare
            let columnIndex = getColumnIndex(columnName);
            x = rows[i].getElementsByTagName('TD')[columnIndex];
            y = rows[i + 1].getElementsByTagName('TD')[columnIndex];

            // Check if the two rows should switch places
            if (sortDirection === 'asc') {

                if (compareValues(x.innerHTML.trim().toLowerCase(), y.innerHTML.trim().toLowerCase()) > 0) {
                    shouldSwitch = true;
                    break;
                }

            } else if (sortDirection === 'desc') {

                if (compareValues(x.innerHTML.trim().toLowerCase(), y.innerHTML.trim().toLowerCase()) < 0) {
                    shouldSwitch = true;
                    break;
                }

            }
        }

        if (shouldSwitch) {
            // If a switch has been marked, make the switch and mark the switch as done
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }

    // Change the sort icon based on the sorting direction
    resetSortIcons();
    sortIcon.innerHTML = sortDirection === 'asc' ? '↑' : '↓';
}
</script>

@endsection