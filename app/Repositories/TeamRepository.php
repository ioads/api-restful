<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function findByApiId($apiId)
    {
        return $this->model->where('api_id', $apiId)->first();
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
        $team = $this->model->find($id);
        $team->update($data);
        return $team;
    }
    public function updateOrCreate(array $find, array $data)
    {
        return $this->model->updateOrCreate($find, $data);
    }

    public function delete(Team $team): int
    {
        return $team->delete();
    }

    public function search(Request $request): \Illuminate\Support\Collection
    {
        $query = DB::table('teams');

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if ($request->has('abbreviation')) {
            $query->where('abbreviation', '=', $request->abbreviation);
        }

        return $query->get();
    }
}
