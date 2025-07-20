<?php

use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
        // return Inertia::render('Welcome');
    })->name('home');

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::resource('/users', UserController::class)
        ->only(['create', 'store'])->middleware('permission:users.create');
    Route::resource('/users', UserController::class)
        ->only(['show', 'index'])->middleware('permission:users.view');
    Route::resource('/users', UserController::class)
        ->only(['edit', 'update'])->middleware('permission:users.update');
    Route::resource('/users', UserController::class)
        ->only(['delete'])->middleware('permission:users.delete');

    Route::resource('/roles', RoleController::class)
        ->only(['create', 'store'])->middleware('permission:roles.create');
    Route::resource('/roles', RoleController::class)
        ->only(['show', 'index'])->middleware('permission:roles.view');
    Route::resource('/roles', RoleController::class)
        ->only(['edit', 'update'])->middleware('permission:roles.update');
    Route::resource('/roles', RoleController::class)
        ->only(['delete'])->middleware('permission:roles.delete');
});





require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
