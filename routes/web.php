<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplaintResponseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Static pages
Route::get('/', function () {
    return view('frontend.index');
})->name('welcome');

Route::get('/terms', function () {
    return view('static.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('static.privacy');
})->name('privacy');

Route::get('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('dashboard', DashboardController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', ])
        ->names([
            'index' => 'dashboard.index',
            'create' => 'dashboard.create',
            'store' => 'dashboard.store',
            'show' => 'dashboard.show',
            'edit' => 'dashboard.edit',
            'update' => 'dashboard.update',
            'destroy' => 'dashboard.destroy',
        ]);
    
    Route::delete('/news/multiple-delete', [NewsController::class, 'multipleDelete'])
        ->name('news.multipleDelete');
    Route::resource('news', NewsController::class);
    
    Route::get('complaints/pending', [ComplaintController::class, 'pending'])
        ->name('complaints.pending');

    Route::resource('complaints', ComplaintController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names([
            'index' => 'complaints.index',
            'create' => 'complaints.create',
            'store' => 'complaints.store',
            'show' => 'complaints.show',
            'edit' => 'complaints.edit',
            'update' => 'complaints.update',
            'destroy' => 'complaints.destroy',
        ]);
    
    Route::resource('complaint-response', ComplaintResponseController::class);
    
    Route::resource('users', UserController::class);
    Route::delete('/users/multiple-delete', [UserController::class, 'multipleDelete'])->name('users.multipleDelete');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});