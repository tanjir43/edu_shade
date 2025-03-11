<?php

namespace App\Providers;

use App\Services\SystemSettingService;
use Illuminate\Support\ServiceProvider;

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
        //
    }
}
