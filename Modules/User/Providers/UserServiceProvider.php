<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\Services\UserFavoriteGamesService;
use Modules\User\Services\UserFavoriteGamesServiceInterface;
use Modules\User\Services\UserService;
use Modules\User\Services\UserServiceInterface;
use Modules\User\Services\UserSocialService;
use Modules\User\Services\UserSocialServiceInterface;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'User';

    /**
     * @var string
     */
    protected $moduleNameLower = 'user';

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

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserSocialServiceInterface::class, UserSocialService::class);
        $this->app->bind(UserFavoriteGamesServiceInterface::class, UserFavoriteGamesService::class);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
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
