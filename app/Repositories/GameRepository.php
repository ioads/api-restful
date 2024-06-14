<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

class GameRepository implements GameRepositoryInterface
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

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->model->find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id): int
    {
        return $this->model->destroy($id);
    }
}
