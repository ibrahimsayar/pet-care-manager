<?php

namespace App\Providers;

use App\Interfaces\v1\Auth\AuthRepositoryInterface;
use App\Interfaces\v1\Breed\BreedRepositoryInterface;
use App\Interfaces\v1\Location\LocationRepositoryInterface;
use App\Repositories\v1\Auth\AuthRepository;
use App\Repositories\v1\Breed\BreedRepository;
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
        $this->app->bind(BreedRepositoryInterface::class, BreedRepository::class);

        // Admin Interface and Repositories
        $this->app->bind(\App\Interfaces\Admin\v1\Auth\AuthRepositoryInterface::class,
            \App\Repositories\Admin\v1\Auth\AuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
