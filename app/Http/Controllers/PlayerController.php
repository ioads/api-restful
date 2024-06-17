<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Models\Team;
use App\Repositories\PlayerRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PlayerController extends Controller
{
    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Player::class);

        $players = $this->playerRepository->all();

        return response()->json($players);
    }

    public function show($id): PlayerResource
    {
        $player = $this->playerRepository->findOrFail($id);

        $this->authorize('view', $player);

        return new PlayerResource($player);
    }

    public function store(PlayerStoreRequest $request): PlayerResource
    {
        $data = $request->validated();

        $player = $this->playerRepository->create($data);

        return new PlayerResource($player);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit($id): PlayerResource
    {
        $player = $this->playerRepository->findOrFail($id);

        $this->authorize('edit', $player);

        return new PlayerResource($player);
    }

    public function update(PlayerUpdateRequest $request, $id): PlayerResource
    {
        $data = $request->validated();

        $team = $this->playerRepository->update($id, $data);

        return new PlayerResource($team);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Player $player)
    {
        $this->authorize('destroy', $player);

        return $this->playerRepository->delete($player);
    }

    public function search(Request $request): Collection
    {
        $this->authorize('search', Player::class);

        return $this->playerRepository->search($request);
    }
}
