<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
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

    public function updateOrCreate(array $find, array $data)
    {
        return $this->model->updateOrCreate($find, $data);
    }

    public function delete(Player $player): int
    {
        return $player->delete();
    }

    public function search(Request $request): \Illuminate\Support\Collection
    {
        $query = DB::table('players');

        if ($request->has('first_name')) {
            $query->where('first_name', 'LIKE', '%'.$request->first_name.'%');
        }

        if ($request->has('last_name')) {
            $query->where('last_name', 'LIKE', '%'.$request->last_name.'%');
        }

        return $query->get();
    }
}
