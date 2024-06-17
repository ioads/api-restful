<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{

    protected User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
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

    public function delete(User $user): int
    {
        return $user->delete();
    }

    public function search(Request $request): \Illuminate\Support\Collection
    {
        $query = DB::table('users');

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if ($request->has('email')) {
            $query->where('email', '=', $request->email);
        }

        return $query->get();
    }
}
