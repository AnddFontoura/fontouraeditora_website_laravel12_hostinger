<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationsController;
use App\Http\Controllers\SiteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [SiteController::class, 'home']);
Route::get('contact', [SiteController::class, 'contact']);
Route::get('publications/{publicationSlug}', [SiteController::class, 'publications']);
Route::get('publication/{id}', [SiteController::class, 'publication']);
Route::get('search', [SiteController::class, 'search']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::prefix('control-panel')->name('control-panel.')->group(function () {
            Route::prefix('publications')->name('publications.')->group(function () {
                Route::get('/', [PublicationsController::class, 'index'])->name('index');
                Route::get('/create', [PublicationsController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [PublicationsController::class, 'create'])->name('edit');
                Route::post('/save', [PublicationsController::class, 'saveOrUpdate'])->name('save');
                Route::put('/update/{id}', [PublicationsController::class, 'saveOrUpdate'])->name('update');
                Route::get('/show/{id}', [PublicationsController::class, 'show'])->name('show');
                Route::delete('/delete/{id}', [PublicationsController::class, 'delete'])->name('delete');
            });
        });
    });
});

require __DIR__.'/auth.php';
