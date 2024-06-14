<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class BallDontLieApiService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function fetchTeams(): array
    {
        $response = $this->client->get('https://api.balldontlie.io/v1/' . 'teams', [
            RequestOptions::HEADERS => [
                'Authorization' => 'eabe2808-4427-4606-832d-c83bf8f1cbc3',
            ]
        ]);

        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        if(!isset($jsonResponse['data'])) {
            throw new \Exception('Não foi possível retornar os times.');
        }

        return $this->transformTeamData($jsonResponse['data']);
    }

    /**
     * @throws GuzzleException
     */
    public function fetchPlayers(): array
    {
        $response = $this->client->get('https://api.balldontlie.io/v1/' . 'players?per_page=100', [
            RequestOptions::HEADERS => [
                'Authorization' => 'eabe2808-4427-4606-832d-c83bf8f1cbc3',
            ]
        ]);

        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        if(!isset($jsonResponse['data'])) {
            throw new \Exception('Não foi possível retornar os jogadores.');
        }
        return $this->transformPlayerData($jsonResponse['data']);
    }

    public function transformTeamData($teams): array
    {
        return array_map(function ($team) {
            return [
                'api_id' => $team['id'],
                'conference' => $team['conference'],
                'division' => $team['division'],
                'city' => $team['city'],
                'name' => $team['name'],
                'full_name' => $team['full_name'],
                'abbreviation' => $team['abbreviation'],
            ];
        }, $teams);
    }

    public function transformPlayerData($players): array
    {
        return array_map(function ($player) {
            return [
                'api_id' => $player['id'],
                'api_team_id' => $player['team']['id'],
                'first_name' => $player['first_name'],
                'last_name' => $player['last_name'],
                'position' => $player['position'],
                'height' => $player['height'],
                'weight' => $player['weight'],
                'jersey_number' => $player['jersey_number'],
                'college' => $player['college'],
                'country' => $player['country'],
                'draft_year' => $player['draft_year'],
                'draft_round' => $player['draft_round'],
                'draft_number' => $player['draft_number'],
            ];
        }, $players);
    }
}
