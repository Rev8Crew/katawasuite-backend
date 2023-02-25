<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix').'.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('games', LaGameController::class);
    $router->resource('achievements', LaAchievementController::class);
    $router->resource('feedback', LaFeedbackController::class);
    $router->resource('users', LaUserController::class);
    $router->resource('notification-releases', LaNotificationReleaseController::class);
});
