<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

class PlayerRepository implements PlayerRepositoryInterface
{
    protected Player $model;

    public function __construct(Player $player)
    {
        $this->model = $player;
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
