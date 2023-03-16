<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;
use VictoRD11\SslCertificationHealthCheck\SslCertificationExpiredCheck;
use VictoRD11\SslCertificationHealthCheck\SslCertificationValidCheck;

class HealthServiceProvider extends ServiceProvider
{
    public function register()
    {
        \Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            CacheCheck::new(),
            CpuLoadCheck::new(),
            QueueCheck::new(),
            ScheduleCheck::new(),
            //SecurityAdvisoriesCheck::new(),
            SslCertificationExpiredCheck::new()->url(config('app.url'))->warnWhenSslCertificationExpiringDay(15)->failWhenSslCertificationExpiringDay(10),
            SslCertificationValidCheck::new()->url(config('app.url')),
        ]);
    }

    public function boot()
    {
    }
}
