<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplaintResponseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailSubmissionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\ComplaintsController as FrontendComplaintsController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Static pages
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

// Frontend routes
Route::get('/berita', [FrontendNewsController::class, 'index'])->name('frontend.news.index');
Route::get('/berita/{id}', [FrontendNewsController::class, 'show'])->name('frontend.news.show');
Route::get('/pengaduan', [FrontendComplaintsController::class, 'index'])->name('frontend.complaints.index');
Route::get('/pengaduan/{id}', [FrontendComplaintsController::class, 'show'])->name('frontend.complaints.show');
// Route::get('/', function () {
//     return view('frontend.index');
// })->name('welcome');

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
    Route::get('/dashboard-masyarakat', [DashboardController::class, 'masyarakat'])->name('dashboard.masyarakat');

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
    
    // Custom route must come before resource route
    Route::get('complaint-response/complaint/{id}', [ComplaintResponseController::class, 'getComplaintDetails'])
        ->name('complaint-response.get-complaint-details');
    Route::resource('complaint-response', ComplaintResponseController::class);

    // Mail submission custom routes
    Route::patch('mail-submissions/{mailSubmission}/status', [MailSubmissionController::class, 'updateStatus'])
        ->name('mail-submissions.update-status');
    Route::post('mail-submissions/{mailSubmission}/generate-pdf', [MailSubmissionController::class, 'generatePdf'])
        ->name('mail-submissions.generate-pdf');
    Route::get('mail-submissions/{mailSubmission}/download-pdf', [MailSubmissionController::class, 'downloadPdf'])
        ->name('mail-submissions.download-pdf');
    
    Route::resource('mail-submissions', MailSubmissionController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names([
            'index' => 'mail-submissions.index',
            'create' => 'mail-submissions.create',
            'store' => 'mail-submissions.store',
            'show' => 'mail-submissions.show',
            'edit' => 'mail-submissions.edit',
            'update' => 'mail-submissions.update',
            'destroy' => 'mail-submissions.destroy',
        ]);
    
    Route::resource('users', UserController::class);
    Route::delete('/users/multiple-delete', [UserController::class, 'multipleDelete'])->name('users.multipleDelete');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});