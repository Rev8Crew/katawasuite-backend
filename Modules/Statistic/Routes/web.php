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

use Modules\Statistic\Http\Controllers\StatisticController;
use Modules\Statistic\Http\Controllers\TimeTrackerController;

Route::prefix('statistic')->middleware('auth:sanctum')->name('statistic.')->group(function () {
    Route::post('get-user-statistic-by-game', [StatisticController::class, 'getUserStatisticByGame'])->name('get_user_statistic_by_game');
    Route::post('add-user-statistic-game', [StatisticController::class, 'addUserStatisticGame'])->name('add_user_statistic_game');

    Route::prefix('time-tracker')->name('time-tracker.')->group(function () {
        Route::post('start', [TimeTrackerController::class, 'start'])->name('start');
        Route::post('end', [TimeTrackerController::class, 'end'])->name('end');

        Route::post('get-time-by-game', [TimeTrackerController::class, 'timeByGame'])->name('time_by_game');
    });
});
