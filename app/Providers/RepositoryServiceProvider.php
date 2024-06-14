<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TeamRepository;
use App\Repositories\TeamRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
    }
}
