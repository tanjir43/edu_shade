<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Settings\SystemSettingController;
use App\Http\Controllers\Auth\UserProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
//Route::get('/email/verify/{hash}','VerifyEmailController@__invoke');
//Route::get('verify-user/{code}/{client_id?}', 'VerifyEmailController@activateUser')->name('activate.user');

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [DashboardController::class, 'index'])->name('users');
    Route::get('/setting', [DashboardController::class, 'index'])->name('setting');

    # Authenticated User Routes
    Route::get('profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::put('update-password', [UserProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/logout-other-sessions', [UserProfileController::class, 'logoutOtherSessions'])->name('logout.other.sessions');


    # Settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('system-settings', [SystemSettingController::class, 'systemSettings']);
        Route::post('system-settings-save', [SystemSettingController::class, 'systemSettingsSave']);
    });

    # Logout Route (Fix)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
