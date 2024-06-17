<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepositoryInterface;
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
        $teams = $this->teamRepository->all();

        return response()->json($teams);
    }

    public function show($id): TeamResource
    {
        $team = $this->teamRepository->findOrFail($id);

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

        return new TeamResource($team);
    }

    public function update(TeamUpdateRequest $request, $id): TeamResource
    {
        $data = $request->validated();

        $team = $this->teamRepository->update($id, $data);

        return new TeamResource($team);
    }

    public function destroy($id)
    {
        return $this->teamRepository->delete($id);
    }

    public function search(Request $request): Collection
    {
        return $this->teamRepository->search($request);
    }
}
