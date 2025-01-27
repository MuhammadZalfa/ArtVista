<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Route for login form (only accessible to guests)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Route for handling login
Route::post('/login', [AuthController::class, 'login']);

// Route for handling logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for register form (only accessible to guests)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');

// Route for handling register submission
Route::post('/register', [AuthController::class, 'register']);

// Grouping routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Admin route accessible only by authenticated users
    Route::get('/admin', [AuthController::class, 'admin'])->name('admin');

    // Show Users Table with Pagination (Admin)
    Route::get('/admin/table', [UserController::class, 'index'])->name('table');

    // Create a new user (Admin)
    Route::post('/admin/user', [UserController::class, 'create'])->name('createUser');

    // Change this route in your routes file
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('editUser'); 

    Route::post('/admin/user/update/{id}', [UserController::class, 'update'])->name('updateUser');

    // Delete user (Admin)
    Route::delete('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    
    // Admin profile page
    Route::get('/admin/profile', [AuthController::class, 'profilAdmin'])->name('profileAdmin');

    Route::get('/admin/album', [AuthController::class, 'albumAdmin'])->name('albumAdmin');
});

// Route to welcome page for authenticated users
Route::get('/', [AuthController::class, 'welcome'])->name('welcome');

// Non-auth routes (can be accessed by anyone)
Route::get('/photos', function() {
    return view('pages.main');
})->name('dashboard');

Route::get('/photos/open', function () {
    return view('pages.buka');
})->name('buka');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/user/album', function () {
    return view('pages.album');
})->name('album');

Route::get('/album', function () {
    return view('pages.albumDiscovery');
})->name('albumDiscovery');

Route::get('/admin/buka', function () {
    return view('admin.buka');
})->name('adminBuka');
