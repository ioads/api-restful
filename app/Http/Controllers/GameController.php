<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Repositories\GameRepositoryInterface;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected GameRepositoryInterface $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index()
    {
        $teams = $this->gameRepository->all();

        return new GameResource($teams);
    }
}
