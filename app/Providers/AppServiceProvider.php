<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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

        $this->bindRepositories();
    }

    private function bindRepositories(): void
    {
        $repositoriesPath   = app_path('Repositories');
        $interfacesPath     = app_path('Repositories/Interfaces');

        $repositoryFiles = File::files($repositoriesPath);

        foreach ($repositoryFiles as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);

            $interfaceName = $filename . 'Interface';

            $interfacePath = $interfacesPath . DIRECTORY_SEPARATOR . $interfaceName . '.php';

            if (File::exists($interfacePath)) {
                $interface  = 'App\Repositories\Interfaces\\' . $interfaceName;
                $repository = 'App\Repositories\\' . $filename;

                $this->app->bind($interface, $repository);
            }
        }
    }

    public function boot(): void
    {
        Event::listen(MigrationsEnded::class, function () {
            Artisan::call('permissions:sync');
        });
    }
}
