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

use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\UserFavoriteGamesController;

Route::prefix('users')->middleware('auth:sanctum')->name('users.')->group(function () {
    Route::post('/get-social-providers', [UserController::class, 'getSocialProviders']);
    Route::post('/change-phone', [UserController::class, 'changePhone']);

    Route::prefix('favorites')->name('favorites.')->group(function () {
        Route::post('add-to-favorites', [UserFavoriteGamesController::class, 'addToFavorites'])->name('add');
        Route::post('remove-from-favorites', [UserFavoriteGamesController::class, 'removeFromFavorites'])->name('remove');

        Route::post('/', [UserFavoriteGamesController::class, 'getUserFavorites'])->name('all');
    });
});
