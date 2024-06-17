<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'api_id' => $this->api_id,
            'api_home_team_id' => $this->api_home_team_id,
            'api_visitor_team_id' => $this->api_visitor_team_id,
            'date' => $this->date,
            'season' => $this->season,
            'status' => $this->status,
            'period' => $this->period,
            'time' => $this->time,
            'postseason' => $this->postseason,
            'home_team_score' => $this->home_team_score,
            'visitor_team_score' => $this->visitor_team_score,
        ];
    }
}
