<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::get('admin/colocations/create', [AdminController::class, 'createColocation'])
        ->name('admin.colocations.create');

    Route::post('admin/colocations', [AdminController::class, 'storeColocation'])
        ->name('admin.colocations.store');
});

