<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $result = cloudTranslate('hello', 'en', 'es');

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::post('/translate', [\App\Http\Controllers\TranslationController::class, 'index'])->name('translate');

    Route::get('/groups', [\App\Http\Controllers\GroupController::class, 'index'])->name('groups.index');
    Route::post('/groups', [\App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
    Route::put('/groups/{group:id}', [\App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
    Route::get('/groups/{group:uid}', [\App\Http\Controllers\GroupController::class, 'show'])->name('groups.show');
    Route::delete('/groups/{group:id}', [\App\Http\Controllers\GroupController::class, 'destroy'])->name('groups.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
