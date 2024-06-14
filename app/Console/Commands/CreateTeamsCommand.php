<?php

namespace App\Console\Commands;

use App\Repositories\TeamRepository;
use App\Services\BallDontLieApiService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class CreateTeamsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-teams-command';
    protected TeamRepository $teamRepository;
    protected BallDontLieApiService $ballDontLieApiService;

    public function __construct(BallDontLieApiService $ballDontLieApiService, TeamRepository $teamRepository)
    {
        parent::__construct();

        $this->teamRepository = $teamRepository;
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
        $teams = $this->ballDontLieApiService->fetchTeams();

        foreach($teams as $team) {
            $this->teamRepository->updateOrCreate(['api_id' => $team['api_id']], $team);
        }
    }
}
