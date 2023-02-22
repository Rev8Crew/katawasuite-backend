<?php

use App\Http\Controllers\TestController;
use App\Http\Middleware\AdminEmailMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::domain(config('app.subdomains.app'))->get('/', function () {
    return view('welcome');
});

/**
 * @internal   Just for a test
 * @deprecated Remove this routes group
 */
Route::/*middleware(AdminEmailMiddleware::class)->*/prefix('test')->group(static function () {
    Route::get('/database', [TestController::class, 'database'])
        ->withoutMiddleware([VerifyCsrfToken::class]);

    Route::get('/queue', [TestController::class, 'queue'])
        ->withoutMiddleware([VerifyCsrfToken::class]);

    Route::any('/dump', [TestController::class, 'dump'])
        ->withoutMiddleware([VerifyCsrfToken::class]);

    Route::post('/upload', [TestController::class, 'upload'])
        ->withoutMiddleware([VerifyCsrfToken::class]);

    Route::get('/url', [TestController::class, 'url'])
        ->withoutMiddleware([VerifyCsrfToken::class]);

    Route::get('/health', HealthCheckResultsController::class);
});
