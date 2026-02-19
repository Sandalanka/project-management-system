<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contrasts\Auth\AuthContrast;
use App\Repositories\Auth\AuthRepository;

class ContrastProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthContrast::class, AuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
