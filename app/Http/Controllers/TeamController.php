<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Repositories\TeamRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TeamController extends Controller
{
    protected TeamRepositoryInterface $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Team::class);

        $teams = $this->teamRepository->all();

        return response()->json($teams);
    }

    public function show($id): TeamResource
    {
        $team = $this->teamRepository->findOrFail($id);

        $this->authorize('view', $team);

        return new TeamResource($team);
    }

    public function store(TeamStoreRequest $request): TeamResource
    {
        $data = $request->validated();

        $team = $this->teamRepository->create($data);

        return new TeamResource($team);
    }

    public function edit($id): TeamResource
    {
        $team = $this->teamRepository->findOrFail($id);

        $this->authorize('edit', $team);

        return new TeamResource($team);
    }

    public function update(TeamUpdateRequest $request, $id): TeamResource
    {
        $data = $request->validated();

        $team = $this->teamRepository->update($id, $data);

        return new TeamResource($team);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Team $team)
    {
        $this->authorize('destroy', $team);

        return $this->teamRepository->delete($team);
    }

    public function search(Request $request): Collection
    {
        $this->authorize('search', Team::class);

        return $this->teamRepository->search($request);
    }
}
