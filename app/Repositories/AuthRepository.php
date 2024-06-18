<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameRepository implements AuthRepositoryInterface
{
    protected Game $model;

    public function __construct(Game $game)
    {
        $this->model = $game;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
