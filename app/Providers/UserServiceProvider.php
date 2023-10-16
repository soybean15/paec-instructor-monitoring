<?php

namespace App\Providers;

use App\Http\Managers\TeacherManager;
use Illuminate\Support\ServiceProvider;
use App\Http\Managers\UserManager;
class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //

        $this->app->bind(UserManager::class, function ($app) {
            return new UserManager($app->make(CreateNewEmployee::class));
        });


        $this->app->singleton(TeacherManager::class, function (Application $app){
            return new TeacherManager();
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
