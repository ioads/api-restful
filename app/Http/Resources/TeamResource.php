<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'conference' => $this->conference,
            'division' => $this->division,
            'city' => $this->city,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'abbreviation' => $this->abbreviation,
        ];
    }
}
