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

use Modules\KatawaCore\Http\Controllers\KatawaCoreController;

Route::prefix('katawacore')->group(function () {
    Route::post('convert/{short}', [KatawaCoreController::class, 'convert']);
    Route::post('json', [KatawaCoreController::class, 'json']);
    Route::post('characters', [KatawaCoreController::class, 'getCharacters']);
});
