<?php

namespace App\Providers;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use App\Policies\GamePolicy;
use App\Policies\PlayerPolicy;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Team::class => TeamPolicy::class,
        Player::class => PlayerPolicy::class,
        Game::class => GamePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
