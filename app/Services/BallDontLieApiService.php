<?php

namespace App\Services;

use App\Services\Traits\TransformData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class BallDontLieApiService
{
    use TransformData;

    protected Client $client;
    protected $baseUrl;
    protected $token;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->baseUrl = config('services.ballDontLie.baseUrl');
        $this->token = config('services.ballDontLie.token');
    }

    /**
     * @throws GuzzleException
     */
    public function fetchTeams(): array
    {
        $response = $this->client->get($this->baseUrl . 'teams', [
            RequestOptions::HEADERS => [
                'Authorization' => $this->token,
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
        $response = $this->client->get($this->baseUrl . 'players?per_page=100', [
            RequestOptions::HEADERS => [
                'Authorization' => $this->token,
            ]
        ]);

        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        if(!isset($jsonResponse['data'])) {
            throw new \Exception('Não foi possível retornar os jogadores.');
        }
        return $this->transformPlayerData($jsonResponse['data']);
    }

    public function fetchGames(): array
    {
        $response = $this->client->get($this->baseUrl . 'games?seasons[]=2023&per_page=200', [
            RequestOptions::HEADERS => [
                'Authorization' => $this->token,
            ]
        ]);

        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        if(!isset($jsonResponse['data'])) {
            throw new \Exception('Não foi possível retornar os jogos.');
        }
        return $this->transformGameData($jsonResponse['data']);
    }
}
