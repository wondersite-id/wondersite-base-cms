<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleTypeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('login', [LoginController::class, 'view'])->name('login-page');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return redirect()->route('cms.dashboard');
});

Route::prefix('cms')->middleware(['web', 'auth'])->name('cms.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Routes
    Route::get('administrators/change-password/{administrator}', [AdminController::class, 'changePassword'])->name('administrators.change-password');
    Route::get('administrators/historical-changes/{administrator}', [AdminController::class, 'historicalChanges'])->name('administrators.historical-changes');
    Route::post('administrators/change-password/{administrator}', [AdminController::class, 'doChangePassword'])->name('administrators.do-change-password');
    Route::resource('administrators', AdminController::class);

    // Customer Routes
    Route::get('customers/change-password/{customer}', [CustomerController::class, 'changePassword'])->name('customers.change-password');
    Route::get('customers/historical-changes/{customer}', [CustomerController::class, 'historicalChanges'])->name('customers.historical-changes');
    Route::post('customers/change-password/{user}', [CustomerController::class, 'doChangePassword'])->name('customers.do-change-password');
    Route::resource('customers', CustomerController::class);

    // Feature Routes
    Route::get('features/historical-changes/{feature}', [FeatureController::class, 'historicalChanges'])->name('features.historical-changes');
    Route::resource('features', FeatureController::class);

    // Menu Routes
    Route::get('menus/historical-changes/{menu}', [MenuController::class, 'historicalChanges'])->name('menus.historical-changes');
    Route::resource('menus', MenuController::class);

    // Setting or Utilites Routes
    Route::get('utilities/historical-changes/{utility}', [UtilityController::class, 'historicalChanges'])->name('utilities.historical-changes');
    Route::resource('utilities', UtilityController::class)->except(['create', 'store', 'destroy']);

    // SEO Routes
    Route::get('seos/historical-changes/{seo}', [SEOController::class, 'historicalChanges'])->name('seos.historical-changes');
    Route::resource('seos', SEOController::class)->only(['index', 'show']);

    // Article Types Routes
    Route::get('article-types/historical-changes/{articleType}', [ArticleTypeController::class, 'historicalChanges'])->name('article-types.historical-changes');
    Route::resource('article-types', ArticleTypeController::class);

    // Article Routes
    Route::get('articles/historical-changes/{article}', [ArticleController::class, 'historicalChanges'])->name('articles.historical-changes');
    Route::resource('articles', ArticleController::class);
});