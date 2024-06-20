<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function register(){
        return view("auth.register");
    }

    public function dashboard(){
        //firstly get all the users data from the database
        $users = User::all();

        return view("auth.dashboard",compact("users"));//pass the users data to the view
    }



    public function registerPost(Request $request){
        //validate first
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6"
        ]);

        $user = new User();
        //now we will create a new user with data from the request
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;
        $user->password = Hash::make($request->password); //hash the password

        //save the user
        if($user->save()){
            return redirect()->route("login")->with("success","User created successfully");
        }
        //if the user is not saved
        return redirect()->route("register")->with("error","User not created");
    }

    public function loginPost(Request $request)
    {
        //first validate the email and password from the request body
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        //now only take email and password from the request body
        $credentials = $request->only("email", "password");

        //now try to authenticate the user
        if(Auth::attempt($credentials)){
            //if the user is authenticated then redirect to the dashboard
            return redirect()->route("dashboard");
        }

        //otherwise redirect back to the login page with an error message
        return redirect()->route("login")->with("error","Invalid credentials");
    }

    //logout function
    public function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
}
