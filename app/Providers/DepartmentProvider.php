<?php

namespace App\Providers;

use App\Http\Managers\DepartmentManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
class DepartmentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DepartmentManager::class, function(Application $app){
            return new DepartmentManager();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
