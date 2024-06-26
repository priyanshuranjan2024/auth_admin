@extends("layouts.default")
@section("title", "ADMIN LTE | REGISTER")
@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">AdminLTE - Register</h2>
        @if (session('error'))
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif
        @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('register.post') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
    </div>
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
    </div>
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
    </div>
    <div class="mb-4">
        <label for="zone" class="block text-sm font-medium text-gray-700">Zone</label>
        <select name="zone" id="zone"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" onchange="updateStateOptions()" required>
            <option value="">Select Zone</option>
            <option value="east">East</option>
            <option value="west">West</option>
            <option value="north">North</option>
            <option value="south">South</option>
        </select>
    </div>
    <div class="mb-4">
        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
        <select name="state" id="state"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" onchange="updateCityOptions()" required>
            <option value="">Select State</option>
        </select>
    </div>
    <div class="mb-4">
        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
        <select name="city" id="city"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"  required>
            <option value="">Select City</option>
        </select>
    </div>
    <div class="mb-4">
        <button type="submit"
            class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700">Register</button>
    </div>
    <div class="text-center text-sm text-gray-600">
        <a href="{{ route('login') }}" class="underline">Already have an account? Login</a>
    </div>
</form>
    </div>
</div>

<script>

    // JavaScript function to update state options based on selected zone
    function updateStateOptions() {
        var zoneSelect = document.getElementById('zone');
        var stateSelect = document.getElementById('state');


        // Clear current state options
        stateSelect.innerHTML = '<option value="">Select State</option>';

        // Get selected zone
        var selectedZone = zoneSelect.value;

        // Populate state options based on selected zone
        if (selectedZone !== '') {
            var states = {
                'east': ['West Bengal', 'Odisha', 'Assam'],
                'west': ['Maharashtra', 'Gujarat', 'Rajasthan'],
                'north': ['Delhi', 'Punjab', 'Uttar Pradesh'],
                'south': ['Karnataka', 'Tamil Nadu', 'Kerala']
            };

            states[selectedZone].forEach(function(state) {
                var option = document.createElement('option');
                option.value = state;
                option.textContent = state;
                stateSelect.appendChild(option);
            });
        }
    }

    function updateCityOptions() {
        var stateSelect = document.getElementById('state');
        var citySelect = document.getElementById('city');
        var cities = {
            'West Bengal': ['Kolkata', 'Siliguri', 'Durgapur'],
            'Odisha': ['Bhubaneswar', 'Cuttack', 'Rourkela'],
            'Assam': ['Guwahati', 'Silchar', 'Dibrugarh'],
            'Maharashtra': ['Mumbai', 'Pune', 'Nagpur'],
            'Gujarat': ['Ahmedabad', 'Surat', 'Vadodara'],
            'Rajasthan': ['Jaipur', 'Jodhpur', 'Udaipur'],
            'Delhi': ['New Delhi', 'Noida', 'Gurgaon'],
            'Punjab': ['Amritsar', 'Ludhiana', 'Jalandhar'],
            'Uttar Pradesh': ['Lucknow', 'Kanpur', 'Agra'],
            'Karnataka': ['Bangalore', 'Mysore', 'Hubli'],
            'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai'],
            'Kerala': ['Kochi', 'Thiruvananthapuram', 'Kozhikode']
        };

        // Clear current city options
        citySelect.innerHTML = '<option value="">Select City</option>';

        // Get selected state
        var selectedState = stateSelect.value;

        // Populate city options based on selected state
        if (selectedState !== '') {
            cities[selectedState].forEach(function(city) {
                var option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    }

    // Initial call to update state options if zone is pre-selected or default
    updateStateOptions();
    updateCityOptions();
</script>


@endsection