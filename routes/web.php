<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
//use App\Http\Controllers\CategoryController;

Route::get('/', [WelcomeController::class, 'index']);

// Companies routes
Route::get('/proveedores/', [CompaniesController::class, 'index'])
		->name('companies.index');
			
Route::get('/proveedores-{page}', [CompaniesController::class, 'index'])
    ->name('companies.index.paged')
    ->whereNumber('page');

// Single Company route
Route::get('/proveedores/{slug}/', [CompanyController::class, 'show'])
		->name('company.show');

// Companies Category routes
Route::get('/{category}/', [CompaniesController::class, 'index'])
    ->where('category', '^(?!.*-\d+$)[a-z0-9-]+$')  // Won't match if ends with -number
    ->name('companies.category.index');

Route::get('/{category}-{page}/', [CompaniesController::class, 'index'])
    ->where('category', '^(?!proveedores$)[a-z0-9-]+$')
    ->whereNumber('page')
    ->name('companies.category.paged');

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';