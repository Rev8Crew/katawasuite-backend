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

use Modules\Vk\Http\Controllers\VkController;

Route::prefix('vk')->group(function() {
    Route::any('wall', [VkController::class, 'wall']);
});
