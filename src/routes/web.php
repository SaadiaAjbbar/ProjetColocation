<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    Route::get('/users/banned', [AdminController::class, 'bannedUsers'])->name('users.banned');

    Route::get('/colocations', [AdminController::class, 'colocations'])->name('colocations.index');

    Route::get('/colocations/create', [AdminController::class, 'createColocation'])->name('colocations.create');

    Route::post('/colocations', [AdminController::class, 'storeColocation'])->name('colocations.store');

    Route::get('/colocations/my_colocations', [AdminController::class, 'myColocation'])->name('my_colocations.index');

    Route::get('/colocations/{colocation}/dashboard', [ColocationController::class, 'dashboard'])->name('colocations.dashboard');
    Route::post('/admin/colocations/{colocation}/cancel', [ColocationController::class, 'cancel'])->name('colocations.cancel');

    //****************categories
    Route::get('/colocations/{colocation}/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/colocations/{colocation}/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('/colocations/{colocation}/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/colocations/{colocation}/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('/colocations/{colocation}/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::delete('/colocations/{colocation}/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //Invitation
    // formulaire invitation
    Route::post('/admin/colocations/{colocation}/invite',[InvitationController::class, 'store'])->name('admin.invitations.store');

    // lien token
    Route::get('/invitation/{token}',[InvitationController::class, 'accept'])->name('invitations.accept');
});
