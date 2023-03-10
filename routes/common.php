<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\AdminEmailMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::middleware(AdminEmailMiddleware::class)->prefix('test')->group(static function () {
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

Route::get('/storage/{filename}', [CommonController::class, 'storage'])->where('filename', '^(?!(api)).*$');

Route::get('privacy', static fn () => view('privacy.privacy-policy'));
Route::get('agreement', static fn () => view('privacy.agreement'));

// For public application
Route::get('/', static fn () => redirect()->route('app', ['any' => 'home']));

/**
 * Ресурсы хранятся в public/app/*, поэтому без префикса app не будет работать
 */
Route::domain((string) config('app.subdomains.app'))->get('/{any}', static fn () => redirect()->route('app', ['any' => 'home']));
Route::domain((string) config('app.subdomains.app'))->get('/app/{any}', [CommonController::class, 'app'])->where('any', '^(?!api|web).*$')->name('app');
