<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepositoryInterface;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected TeamRepositoryInterface $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $teams = $this->teamRepository->all();

        return new TeamResource($teams);
    }
}
