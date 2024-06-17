<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Repositories\PlayerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PlayerController extends Controller
{
    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function index()
    {
        $players = $this->playerRepository->all();

        return response()->json($players);
    }

    public function show($id): PlayerResource
    {
        $team = $this->playerRepository->findOrFail($id);

        return new PlayerResource($team);
    }

    public function store(PlayerStoreRequest $request): PlayerResource
    {
        $data = $request->validated();

        $player = $this->playerRepository->create($data);

        return new PlayerResource($player);
    }

    public function edit($id): PlayerResource
    {
        $player = $this->playerRepository->findOrFail($id);

        return new PlayerResource($player);
    }

    public function update(PlayerUpdateRequest $request, $id): PlayerResource
    {
        $data = $request->validated();

        $team = $this->playerRepository->update($id, $data);

        return new PlayerResource($team);
    }

    public function destroy($id)
    {
        return $this->playerRepository->delete($id);
    }

    public function search(Request $request): Collection
    {
        return $this->playerRepository->search($request);
    }
}
