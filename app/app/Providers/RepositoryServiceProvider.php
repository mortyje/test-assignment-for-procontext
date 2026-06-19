<?php

namespace App\Providers;

use App\Repositories\Contracts\LinkRepositoryInterface;
use App\Repositories\Eloquent\LinkRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            LinkRepositoryInterface::class,
            LinkRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
