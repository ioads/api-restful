<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    protected Team $model;

    public function __construct(Team $team)
    {
        $this->model = $team;
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
