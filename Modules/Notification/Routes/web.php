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

use Modules\Notification\Http\Controllers\NotificationController;

Route::prefix('notifications')->middleware('auth:sanctum')->name('notifications.')->group(function () {
    Route::get('unsubscribe/{code}/{token}', [NotificationController::class, 'unsubscribe'])->name('unsubscribe');

    Route::post('get-releases-by-user', [NotificationController::class, 'getReleasesByUser'])->name('get-releases-by-user');

    Route::post('change-subscribe', [NotificationController::class, 'changeSubscribe'])->name('change-subscribe');

    Route::post('subscribe-to-all', [NotificationController::class, 'subscribeToAll'])->name('subscribe-to-all');
    Route::post('unsubscribe-to-all', [NotificationController::class, 'unsubscribeToAll'])->name('unsubscribe-to-all');
});
