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

use Modules\Game\Http\Controllers\GameController;

Route::prefix('games')->middleware('auth:sanctum')->name('games.')->group(function () {
    Route::post('/', [GameController::class, 'index'])->name('index');

    Route::get('play/{short}', [GameController::class, 'play'])->name('play');

    Route::post('sync', [GameController::class, 'sync'])->name('sync');

    // В самом конце
    Route::post('/{short}', [GameController::class, 'show'])->name('show');
});
