<?php

namespace App\Repositories;

use App\Models\Game;

interface GameRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function updateOrCreate(array $find, array $data);

    public function delete(Game $game);
}
