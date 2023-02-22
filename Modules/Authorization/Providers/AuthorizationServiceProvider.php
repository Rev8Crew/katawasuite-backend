<?php

namespace Modules\Authorization\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Authorization\Services\AuthService;
use Modules\Authorization\Services\AuthServiceInterface;
use Modules\Authorization\Services\AuthSocialService;
use Modules\Authorization\Services\AuthSocialServiceInterface;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Authorization';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'authorization';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
