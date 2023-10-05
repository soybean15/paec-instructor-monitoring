<?php

namespace App\Providers;

use App\Http\Managers\SubjectManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
class SubjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->singleton(SubjectManager::class, function (Application $app) {
            return new SubjectManager();
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
