<?php

namespace App\Providers;

use App\Interfaces\v1\Auth\AuthRepositoryInterface;
use App\Interfaces\v1\Location\LocationRepositoryInterface;
use App\Repositories\v1\Auth\AuthRepository;
use App\Repositories\v1\Location\LocationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
