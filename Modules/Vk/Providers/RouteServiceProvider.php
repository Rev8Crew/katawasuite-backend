<?php

namespace Modules\Vk\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Providers\RouteServiceProvider as AppRouteServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Vk\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->prefix(AppRouteServiceProvider::WEB_PREFIX)
            ->namespace($this->moduleNamespace)
            ->group(module_path('Vk', '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $prefix = AppRouteServiceProvider::API_PREFIX . '/' . AppRouteServiceProvider::API_VERSION;
        Route::prefix($prefix)
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Vk', '/Routes/api.php'));
    }
}
