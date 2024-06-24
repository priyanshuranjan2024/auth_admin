<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function dashboard(Request $request)
    {
        // Retrieve sort parameters
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        // Store sorting parameters in session
        session(['sort' => $sort, 'order' => $order]);

        // Retrieve search parameters
        $searchName = $request->input('search_name', '');
        $searchEmail = $request->input('search_email', '');
        $searchLocation = $request->input('search_location', '');
        $status = $request->input('status', '');

        // Query to get the count of all users
        $totalUsersCount = User::whereNull('deleted_at')->count();

        // Query to get the count of active users
        $activeUsersCount = User::whereNull('deleted_at')->where('status', 'active')->count();

        // Query to get the count of inactive users
        $inactiveUsersCount = User::whereNull('deleted_at')->where('status', 'inactive')->count();

        // Query to paginate users with sorting and searching
        $usersQuery = User::whereNull('deleted_at')
            ->when($searchName, function ($query) use ($searchName) {
                return $query->where('name', 'like', '%' . $searchName . '%');
            })
            ->when($searchEmail, function ($query) use ($searchEmail) {
                return $query->where('email', 'like', '%' . $searchEmail . '%');
            })
            ->when($searchLocation, function ($query) use ($searchLocation) {
                return $query->where('location', 'like', '%' . $searchLocation . '%');
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy($sort, $order);

        // Paginate users
        $users = $usersQuery->paginate(10)
            ->appends(['sort' => $sort, 'order' => $order, 'search_name' => $searchName, 'search_email' => $searchEmail, 'search_location' => $searchLocation, 'status' => $status]);

        // Return the view with the data and parameters
        return view('auth.dashboard', compact("users", "activeUsersCount", "inactiveUsersCount", "totalUsersCount", "sort", "order", "searchName", "searchEmail", "searchLocation", "status"));
    }

    public function search_data(Request $request)
    {
        // Retrieve sort parameters
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        // Store sorting parameters in session
        session(['sort' => $sort, 'order' => $order]);

        // Retrieve search parameters
        $searchName = $request->input('search_name', '');
        $searchEmail = $request->input('search_email', '');
        $searchLocation = $request->input('search_location', '');
        $status = $request->input('status', '');

        // Query to search users
        $usersQuery = User::whereNull('deleted_at')
            ->when($searchName, function ($query) use ($searchName) {
                return $query->where('name', 'like', '%' . $searchName . '%');
            })
            ->when($searchEmail, function ($query) use ($searchEmail) {
                return $query->where('email', 'like', '%' . $searchEmail . '%');
            })
            ->when($searchLocation, function ($query) use ($searchLocation) {
                return $query->where('location', 'like', '%' . $searchLocation . '%');
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy($sort, $order);

        // Paginate users
        $users = $usersQuery->paginate(10)
            ->appends(['sort' => $sort, 'order' => $order, 'search_name' => $searchName, 'search_email' => $searchEmail, 'search_location' => $searchLocation, 'status' => $status]);

        // Retrieve counts based on the full user list
        $totalUsersCount = User::whereNull('deleted_at')->count();
        $activeUsersCount = User::whereNull('deleted_at')->where('status', 'active')->count();
        $inactiveUsersCount = User::whereNull('deleted_at')->where('status', 'inactive')->count();

        // Return the view with the necessary data
        return view('auth.dashboard', compact("users", "activeUsersCount", "inactiveUsersCount", "totalUsersCount", "searchName", "searchEmail", "searchLocation", "sort", "order", "status"));
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }

    public function edit_user($id)
    {
        $data = User::findOrFail($id);

        return view('auth.edit', compact('data'));
    }

    public function update_data(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "location" => "required",
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $ext=$image->getClientOriginalExtension();
            $image_name=time().'.'.$ext;
            $image->move("storage/images",$image_name);
            $user->image=$image_name;
        }
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('auth.showUser', compact('user'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return redirect()->back();
    }

    public function registerPost(Request $request)
    {
        // Validate the request
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "location" => "required",
        ]);

        // Create new user instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;
        $user->password = Hash::make($request->password);

        // Save the user
        if ($user->save()) {
            return redirect()->route("login")->with("success", "User created successfully");
        }

        return redirect()->route("register")->with("error", "User not created");
    }

    public function loginPost(Request $request)
    {
        // Validate the request
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        // Attempt to log in the user
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->route("dashboard");
        }

        return redirect()->route("login")->with("error", "Invalid credentials");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
