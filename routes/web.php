<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;

Route::get('/', [WelcomeController::class, 'index']);

// Companies routes
Route::get('/proveedores', [CompaniesController::class, 'index'])
    ->name('companies.index');

// Search results route
Route::get('/search', [CompaniesController::class, 'search'])
    ->name('companies.search');

// Single Company route
Route::get('/proveedores/{slug}/', [CompanyController::class, 'show'])
    ->name('company.show');

// Dynamic term resolver route for domain/xyz_t/xyz
Route::get('/{firstLevel}_t/{secondLevel}', function ($firstLevel, $secondLevel) {
    // Handle logic for xyz_t/xyz routes
    return app(CompaniesController::class)->tipoProvIndex($firstLevel, $secondLevel);
})
->where('firstLevel', '^(?!.*-\d+$)[a-z0-9-]+$')
->where('secondLevel', '^(?!.*-\d+$)[a-z0-9-]+$')
->name('companies.tipoProv.index');

// Dynamic term resolver route for domain/term1/term2
Route::get('/{term1}/{term2}', function ($term1, $term2) {
    // Check if term2 is a province or city
    if ($province = \App\Models\Province::where('slug', $term2)->first()) {
        return app(CompaniesController::class)->categoryProvinceIndex($term1, $term2);
    } elseif ($city = \App\Models\City::where('slug', $term2)->first()) {
        return app(CompaniesController::class)->categoryCityIndex($term1, $term2);
    }
    abort(404); // Term2 not found in province or city tables
})
->where('term1', '^(?!.*-\d+$)[a-z0-9-]+$')
->where('term2', '^(?!.*-\d+$)[a-z0-9-]+$')
->name('companies.category.location');

// Single directory cases (domain/term)
Route::get('/{term}', function ($term) {
    // Check in order: Category → Province → City
    if ($category = \App\Models\Category::where('slug', $term)->first()) {
        return app(CompaniesController::class)->index($term);
    } elseif ($province = \App\Models\Province::where('slug', $term)->first()) {
        return app(ProvincesController::class)->index($term);
    } elseif ($city = \App\Models\City::where('slug', $term)->first()) {
        return app(CitiesController::class)->index($term);
    }
    abort(404); // Term not found in any table
})
->where('term', '^(?!.*-\d+$)[a-z0-9-]+$')
->name('term.resolve');

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';