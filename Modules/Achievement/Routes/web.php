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

use Modules\Achievement\Http\Controllers\AchievementController;

Route::prefix('achievements')->middleware('auth:sanctum')->name('achievements.')->group(function () {
    Route::post('/user', [AchievementController::class, 'getAchievementsAndMarkCompletedByUser'])->name('user');
    Route::post('/game/{game}', [AchievementController::class, 'getAchievementsByGame'])->name('game');

    Route::post('/complete', [AchievementController::class, 'completeByShort'])->name('complete');
});
