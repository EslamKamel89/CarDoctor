<?php

use App\Http\Controllers\Dashboard\BrandController;
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

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('brands', BrandController::class);
});





require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
