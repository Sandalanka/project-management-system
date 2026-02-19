<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contrasts\Auth\AuthContrast;
use App\Repositories\Auth\AuthRepository;
use App\Contrasts\Project\ProjectContrast;
use App\Repositories\Project\ProjectRepository;
use App\Contrasts\Task\TaskContrast;
use App\Repositories\Task\TaskRepository;
use App\Contrasts\Comment\CommentContrast;
use App\Repositories\Comment\CommentRepository;

class ContrastProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthContrast::class, AuthRepository::class);
        $this->app->bind(ProjectContrast::class, ProjectRepository::class);
        $this->app->bind(TaskContrast::class, TaskRepository::class);
        $this->app->bind(CommentContrast::class, CommentRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
