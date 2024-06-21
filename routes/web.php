

<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('layouts.default');
});

Route::get('/search_data',[AuthController::class,"search_data"])->name('search_data');
Route::get('/delete_user/{id}',[AuthController::class,"delete_user"])->name('delete');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::middleware('auth')->get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

