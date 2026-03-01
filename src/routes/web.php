<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\is_member;
use App\Http\Middleware\is_owner;
use App\Http\Middleware\ontreColocation;
use App\Http\Middleware\virifie;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/colocations/create', [ColocationController::class, 'createColocation'])->name('colocations.create');
    Route::post('/colocations', [ColocationController::class, 'storeColocation'])->name('colocations.store');
    Route::get('/colocations/my_colocations', [ColocationController::class, 'myColocation'])->name('my_colocations.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('dashboardAdmin', [DashbordController::class, 'index'])->name('dashboardAdmin');

    Route::get('/users', [UserController::class, 'users'])->name('users.index');

    Route::get('/colocations', [ColocationController::class, 'colocations'])->name('colocations.index');

    Route::get('/users/banned', [UserController::class, 'bannedUsers'])->name('users.banned');
});

Route::middleware(['auth', is_owner::class])->group(function () {

    Route::get('/colocations/{colocation}/dashboardOwner', [DashbordController::class, 'dashboardOwner'])->name('dashboardOwner');

    Route::post('/colocations/{colocation}/invite', [InvitationController::class, 'store'])->name('invitations.store');

    Route::get('/colocations/{colocation}/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/colocations/{colocation}/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('/colocations/{colocation}/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/colocations/{colocation}/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('/colocations/{colocation}/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::delete('/colocations/{colocation}/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/colocations/{colocation}/cancel', [ColocationController::class, 'cancel'])->name('colocations.cancel');
});

/******////// */

Route::middleware(['auth', virifie::class])->group(function () {
    Route::get('/', [DashbordController::class, 'dashboardUser'])->name('dashboardUser');
});


Route::middleware(['auth', is_member::class])->group(function () {
    Route::get('/dashboardMember/{colocation}', [DashbordController::class, 'dashboardMember'])->name('dashboardMember');
    Route::get('/colocations/{colocation}/members', [ColocationController::class, 'members'])->name('colocations.members');
    Route::delete('/colocations/{colocation}/leave', [ColocationController::class, 'leave'])->name('colocations.leave');
    Route::get('/colocations/{colocation}/depenses', [ColocationController::class, 'depenses'])->name('colocations.depenses');
});

/******////// */
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
// other routes
Route::get('/invitation/{token}', [InvitationController::class, 'accept'])->name('invitations.accept');

Route::middleware(['auth', ontreColocation::class])->group(function () {
    Route::get('/colocations/{colocation}/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
    Route::post('/colocations/{colocation}/depenses', [DepenseController::class, 'store'])->name('depenses.store');
    Route::post('/paiements/valider/{colocation}/{user}', [PaiementController::class, 'valider'])->name('paiements.valider');
});
