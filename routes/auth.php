<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemUsersController;
use App\Http\Middleware\AbleTo;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');





    // route for user section 
    Route::get('/user/index', function () {
        return view('user.dash');
    })->name('user.index');
    Route::get('/user/dash', function () {
        return view('user.dash');
    })->name('user.dash');


    Route::prefix('dashboard')->group(function () {


        include('system.php'); // include all routes for system

        include('vendor.php'); // include all route for vendor

        include('reseller.php'); // include all route for reseller

        // role and permission manage
        Route::get('roles', [RoleController::class, 'admin_list'])->name('system.role.list')->middleware(AbleTo::class . ':role_list');
        Route::get('roles/edit', [RoleController::class, 'admin_edit'])->name('system.role.edit')->middleware(AbleTo::class . ":role_edit");
        Route::post('role-to-users', [RoleController::class, 'multiple_user_to_single_role'])->name('system.role.to-user')->middleware(AbleTo::class . ':sync_role_to_user'); // single role to multiple users

        /**
         * user to role
         */
        Route::post('user-to-roles', [RoleController::class, 'multiple_role_to_single_user'])->name('multiple_role_to_single_user')->middleware(AbleTo::class . ':sync_role_to_user'); // multiple role to single user
        Route::post('permissions/{role}/to-role', [RoleController::class, 'system_give_permission_to_role'])->name('system.permissions.to-role')->middleware(AbleTo::class . ':sync_permission_to_role');
        Route::post('permissions/{user}/to-user', [RoleController::class, 'system_give_permission_to_user'])->name('system.permissions.to-user')->middleware(AbleTo::class . ':sync_permission_to_role');

        // permit to make users task
        Route::get('users', [SystemUsersController::class, 'admin_view'])->name('system.users.view')->middleware(AbleTo::class . ":users_view");
        Route::get('user/edit/{email}', [SystemUsersController::class, 'admin_edit'])->name('system.users.edit')->middleware(AbleTo::class . ":users_edit");
        Route::post('user/update/{id}', [SystemUsersController::class, 'admin_update'])->name("system.users.update")->middleware(AbleTo::class . ":users_update");
    });
});
