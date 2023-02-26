<?php

use App\Admin\Controllers\LaAchievementController;
use App\Admin\Controllers\LaFeedbackController;
use App\Admin\Controllers\LaGameController;
use App\Admin\Controllers\LaNotificationReleaseController;
use App\Admin\Controllers\LaUserController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix').'.',
], function (Router $router) {
    $router->get('/', [\App\Admin\Controllers\HomeController::class, 'index'])->name('home');

    $router->resource('games', LaGameController::class);
    $router->resource('achievements', LaAchievementController::class);
    $router->resource('feedback', LaFeedbackController::class);
    $router->resource('users', LaUserController::class);
    $router->resource('notification-releases', LaNotificationReleaseController::class);
});
