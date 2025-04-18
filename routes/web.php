<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Settings\LanguageController;
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

    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
        // SclClass Routes
        Route::get('class/filter', [App\Http\Controllers\Admin\Core\SclClassController::class, 'filter'])->name('class.filter');
        Route::post('class/restore/{id}', [App\Http\Controllers\Admin\Core\SclClassController::class, 'restore'])->name('class.restore');
        Route::delete('class/force-delete/{id}', [App\Http\Controllers\Admin\Core\SclClassController::class, 'forceDelete'])->name('class.forceDelete');

        // Bulk operations routes
        Route::post('class/bulk-destroy', [App\Http\Controllers\Admin\Core\SclClassController::class, 'bulkDestroy'])->name('class.bulkDestroy');
        Route::post('class/bulk-restore', [App\Http\Controllers\Admin\Core\SclClassController::class, 'bulkRestore'])->name('class.bulkRestore');
        Route::post('class/bulk-force-delete', [App\Http\Controllers\Admin\Core\SclClassController::class, 'bulkForceDelete'])->name('class.bulkForceDelete');

        Route::resource('class', App\Http\Controllers\Admin\Core\SclClassController::class);
    });

    Route::post('/update-language', [LanguageController::class, 'updateLanguage'])->name('update.language');


    # Logout Route (Fix)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
