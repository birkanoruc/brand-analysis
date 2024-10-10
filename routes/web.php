<?php
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\AnalysisResultController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/import', [DashboardController::class, 'import'])->name('dashboard.import');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', controller: BrandController::class);
    Route::resource('analysis', controller: AnalysisController::class);
    Route::resource('uploads', controller: UploadController::class);

});

Route::get("/analysis-result/{analysi}", [AnalysisResultController::class, "show"])->name("analysis-result.show");

require __DIR__.'/auth.php';

// Auth::routes();
