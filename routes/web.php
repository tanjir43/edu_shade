<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Auth\UserProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
//Route::get('/email/verify/{hash}','VerifyEmailController@__invoke');
//Route::get('verify-user/{code}/{client_id?}', 'VerifyEmailController@activateUser')->name('activate.user');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [DashboardController::class, 'index'])->name('users');
    Route::get('/setting', [DashboardController::class, 'index'])->name('setting');

    # Auth
    Route::get('profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('logout', [AuthenticatedSessionController::class, 'logout']);
});
