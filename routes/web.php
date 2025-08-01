<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CarModelController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Resources\CarModelResource;
use App\Models\Brand;
use App\Models\CarModel;
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
    Route::resource('/brands', BrandController::class);
    Route::resource('/car-models', CarModelController::class);
});
Route::get('/test/{id}', function () {

    $carModels = CarModel::with('brand')
        ->orderBy('name_ar')
        ->get();
    return response()->json([
        'car_models' => CarModelResource::collection($carModels),
        'brands' => Brand::orderBy('name_ar')->pluck('name_ar', 'id'), // For dropdown
    ]);
});




require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
