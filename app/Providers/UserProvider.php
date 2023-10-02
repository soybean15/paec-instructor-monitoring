<?php

namespace App\Providers;

use App\Http\Managers\UserManager;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
