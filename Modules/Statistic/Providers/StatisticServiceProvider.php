<?php

namespace Modules\Statistic\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Statistic\Services\StatisticService;
use Modules\Statistic\Services\StatisticServiceInterface;
use Modules\Statistic\Services\TimeTrackerService;
use Modules\Statistic\Services\TimeTrackerServiceInterface;

class StatisticServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'Statistic';

    /**
     * @var string
     */
    protected $moduleNameLower = 'statistic';

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

        $this->app->bind(TimeTrackerServiceInterface::class, TimeTrackerService::class);
        $this->app->bind(StatisticServiceInterface::class, StatisticService::class);
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
