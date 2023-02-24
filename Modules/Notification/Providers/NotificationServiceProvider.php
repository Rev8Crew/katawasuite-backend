<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Notification\Services\NotificationReleaseService;
use Modules\Notification\Services\NotificationReleaseServiceInterface;
use Modules\Notification\Services\NotificationService;
use Modules\Notification\Services\NotificationServiceInterface;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'Notification';

    /**
     * @var string
     */
    protected $moduleNameLower = 'notification';

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

        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);
        $this->app->bind(NotificationReleaseServiceInterface::class, NotificationReleaseService::class);
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
