<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColocationController;
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

    Route::get('admin/colocations/create', [AdminController::class, 'createColocation'])->name('admin.colocations.create');
    Route::post('admin/colocations', [AdminController::class, 'storeColocation'])->name('admin.colocations.store');
    Route::get('admin/colocations/my_colocations',[AdminController::class,'myColocation'])->name('admin.my_colocations.index');

   Route::get('/colocations/{colocation}/dashboard',[ColocationController::class, 'dashboard'])->name('colocation.dashboard');

    Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('admin/users/banned', [AdminController::class, 'bannedUsers'])->name('admin.users.banned');
    Route::get('admin/colocations', [AdminController::class, 'colocations'])->name('admin.colocations.index');

});
