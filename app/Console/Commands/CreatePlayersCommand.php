<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use App\Repositories\TeamRepository;
use App\Services\BallDontLieApiService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class CreatePlayersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-players-command';
    protected PlayerRepository $playerRepository;
    protected BallDontLieApiService $ballDontLieApiService;

    public function __construct(BallDontLieApiService $ballDontLieApiService, PlayerRepository $playerRepository)
    {
        parent::__construct();

        $this->playerRepository = $playerRepository;
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
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $players = $this->ballDontLieApiService->fetchPlayers();

        foreach($players as $player) {
            $this->playerRepository->updateOrCreate(['api_id' => $player['api_id']], $player);
        }
    }
}
