<?php

namespace App\Providers;

use App\Repositories\GameRepository;
use App\Repositories\GameRepositoryInterface;
use App\Repositories\PlayerRepository;
use App\Repositories\PlayerRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TeamRepository;
use App\Repositories\TeamRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }
}
