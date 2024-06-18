<?php

namespace App\Services\Traits;

trait TransformData
{
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

    public function transformGameData($players): array
    {
        return array_map(function ($player) {
            return [
                'api_id' => $player['id'],
                'api_home_team_id' => $player['home_team']['id'],
                'api_visitor_team_id' => $player['visitor_team']['id'],
                'date' => $player['date'],
                'season' => $player['season'],
                'status' => $player['status'],
                'period' => $player['period'],
                'time' => $player['time'],
                'postseason' => $player['postseason'] ?? null,
                'home_team_score' => $player['home_team_score'] ?? null,
                'visitor_team_score' => $player['visitor_team_score'] ?? null,
            ];
        }, $players);
    }
}
