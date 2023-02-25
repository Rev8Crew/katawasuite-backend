<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $driver = app()->environment('production') ? \Mail::getDefaultDriver() : 'log';
        //\Mail::setDefaultDriver($driver);
    }
}
