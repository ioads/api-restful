<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Http\Resources\GameResource;
use App\Repositories\GameRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GameController extends Controller
{
    protected GameRepositoryInterface $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index(): JsonResponse
    {
        $games = $this->gameRepository->all();

        return response()->json($games);
    }

    public function show($id): GameResource
    {
        $team = $this->gameRepository->findOrFail($id);

        return new GameResource($team);
    }

    public function store(GameStoreRequest $request): GameResource
    {
        $data = $request->validated();

        $team = $this->gameRepository->create($data);

        return new GameResource($team);
    }

    public function edit($id): GameResource
    {
        $team = $this->gameRepository->findOrFail($id);

        return new GameResource($team);
    }

    public function update(GameUpdateRequest $request, $id): GameResource
    {
        $data = $request->validated();

        $team = $this->gameRepository->update($id, $data);

        return new GameResource($team);
    }

    public function destroy($id)
    {
        return $this->gameRepository->delete($id);
    }

    public function search(Request $request): Collection
    {
        return $this->gameRepository->search($request);
    }
}
