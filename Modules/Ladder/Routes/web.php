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

use Modules\Ladder\Http\Controllers\LadderController;

Route::prefix('ladder')->middleware('auth:sanctum')->name('ladder.')->group(function () {
    Route::post('/get-new-year-ladder', [LadderController::class, 'getNewYearLadder'])->name('get-new-year-ladder-2022');
    Route::post('/get-new-year-stats', [LadderController::class, 'getNewYearStats'])->name('get-new-year-stats-2022');
});
