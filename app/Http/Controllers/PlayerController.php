<?php

namespace App\Http\Controllers;

use App\Repositories\PlayerRepositoryInterface;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function index()
    {
        $teams = $this->playerRepository->all();

        return new PlayerResource($teams);
    }
}
