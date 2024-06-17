<?php

namespace App\Console\Commands;

use App\Repositories\GameRepository;
use App\Services\BallDontLieApiService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class CreateGamesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-games-command';
    protected GameRepository $gameRepository;
    protected BallDontLieApiService $ballDontLieApiService;

    public function __construct(BallDontLieApiService $ballDontLieApiService, GameRepository $gameRepository)
    {
        parent::__construct();

        $this->gameRepository = $gameRepository;
        $this->ballDontLieApiService = $ballDontLieApiService;
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        $games = $this->ballDontLieApiService->fetchGames();

        foreach($games as $game) {
            $this->gameRepository->updateOrCreate(['api_id' => $game['api_id']], $game);
        }
    }
}
