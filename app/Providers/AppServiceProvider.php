<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use App\Services\SystemSettingService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\MigrationsEnded;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
    */
    public function register(): void
    {
        $this->app->singleton('system_setting', function ($app) {
            return new SystemSettingService();
        });
    }

    /**
     * Bootstrap any application services.
    */
    public function boot(): void
    {
        Event::listen(MigrationsEnded::class, function () {
            Artisan::call('permissions:sync');
        });
    }
}
