<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Repositories\GameRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Game::class);

        $games = $this->gameRepository->all();

        return response()->json($games);
    }

    /**
     * @throws AuthorizationException
     */
    public function show($id): GameResource
    {
        $game = $this->gameRepository->findOrFail($id);

        $this->authorize('view', $game);

        return new GameResource($game);
    }

    public function store(GameStoreRequest $request): GameResource
    {
        $data = $request->validated();

        $team = $this->gameRepository->create($data);

        return new GameResource($team);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit($id): GameResource
    {
        $game = $this->gameRepository->findOrFail($id);

        $this->authorize('edit', $game);

        return new GameResource($game);
    }

    public function update(GameUpdateRequest $request, $id): GameResource
    {
        $data = $request->validated();

        $team = $this->gameRepository->update($id, $data);

        return new GameResource($team);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Game $game)
    {
        $this->authorize('destroy', $game);

        return $this->gameRepository->delete($game);
    }

    public function search(Request $request): Collection
    {
        return $this->gameRepository->search($request);
    }
}
