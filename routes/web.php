

<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('layouts.default');
});


Route::get('/get-states', [AuthController::class, 'getStates'])->name('get.states');
Route::get('/get-cities', [AuthController::class, 'getCities'])->name('get.cities');




Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');





Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/search_data', [AuthController::class, 'search_data'])->name('search_data');
    Route::get('/user/{id}', [AuthController::class, 'show'])->name('user.show');
    Route::get('/delete_user/{id}', [AuthController::class, 'delete_user'])->name('delete');
    Route::get('/edit_user/{id}', [AuthController::class, 'edit_user'])->name('edit_user');
    Route::post('/update_data/{id}', [AuthController::class, 'update_data'])->name('update_data');
    Route::get('toggle_status/{id}', [AuthController::class, 'toggleStatus'])->name('toggleStatus');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

