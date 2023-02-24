<?php

namespace Modules\Achievement\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Achievement\Services\AchievementService;
use Modules\Achievement\Services\AchievementServiceInterface;
use Modules\Achievement\Services\RewardService;
use Modules\Achievement\Services\RewardServiceInterface;

class AchievementServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'Achievement';

    /**
     * @var string
     */
    protected $moduleNameLower = 'achievement';

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

        $this->app->bind(AchievementServiceInterface::class, AchievementService::class);
        $this->app->bind(RewardServiceInterface::class, RewardService::class);
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
