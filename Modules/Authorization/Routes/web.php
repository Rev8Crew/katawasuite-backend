<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Authorization\Http\Controllers\AuthorizationController;

Route::prefix('auth')->name('auth.')->group(function () {

    Route::get('login', [AuthorizationController::class, 'showLoginForm'])->name('show-login-form');
    Route::post('app-login', [AuthorizationController::class, 'appLogin'])->name('app-login');

    Route::post('register', [AuthorizationController::class, 'register'])->name('register');

    Route::post('login', [AuthorizationController::class, 'login'])->name('login');
    Route::post('logout', [AuthorizationController::class, 'logout'])->name('logout');

    Route::post('change-credentials', [AuthorizationController::class, 'changeCredentials'])->name('change_credentials');
    Route::post('change-password', [AuthorizationController::class, 'changePassword'])->name('change_password');

    Route::post('reset-password', [AuthorizationController::class, 'resetPassword'])->middleware('throttle:2,60')->name('reset_password');
    Route::post('resend-activation', [AuthorizationController::class, 'reSendActivationEmail'])->middleware('throttle:1,60')->name('resend_activation');

    Route::get('/verify/{token}', [AuthorizationController::class, 'verify'])->name('verify');
    Route::any('/reset/{token}', [AuthorizationController::class, 'resetPasswordView'])->name('reset_password_view');

    Route::prefix('providers')->name('providers.')->group(static function () {
        Route::post('/', [AuthorizationController::class, 'providers']);

        Route::get('/redirect/{provider}', [AuthorizationController::class, 'redirect'])->name('redirect');
        Route::get('/callback/{provider}', [AuthorizationController::class, 'callback'])->name('callback');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/me', [AuthorizationController::class, 'me'])->name('me');
    });
});
