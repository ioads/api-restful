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
}
