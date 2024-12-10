<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    // return Inertia::render('Dashboard');
    return Inertia::render('HomeView');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tables', function () {
    return Inertia::render('TablesView');
})->name('tables');

Route::get('/forms', function () {
    return Inertia::render('FormsView');
})->name('forms');

Route::get('/ui', function () {
    return Inertia::render('UiView');
})->name('ui');

Route::get('/responsive', function () {
    return Inertia::render('ResponsiveView');
})->name('responsive');

Route::get('/profile', function () {
    return Inertia::render('ProfileView');
})->name('profile');

Route::get('/sign_in', function () {
    return Inertia::render('Auth/Login');
})->name('sign_in');

Route::get('/error', function () {
    return Inertia::render('ErrorView');
})->name('error');

require __DIR__.'/auth.php';
