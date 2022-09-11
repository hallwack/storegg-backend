<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {

    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('user-profile', [UserProfileController::class, 'index'])->name('user-profile');
    Route::post('user-profile', [UserProfileController::class, 'update'])->name('profile.update');

});
