<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'api_id' => $this->api_id,
            'api_team_id' => $this->api_team_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'position' => $this->position,
            'height' => $this->height,
            'weight' => $this->weight,
            'jersey_number' => $this->jersey_number,
            'college' => $this->college,
            'country' => $this->country,
            'draft_year' => $this->draft_year,
            'draft_round' => $this->draft_round,
            'draft_number' => $this->draft_number,
        ];
    }
}
