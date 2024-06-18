<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_id',
        'api_team_id',
        'first_name',
        'last_name',
        'position',
        'height',
        'weight',
        'jersey_number',
        'college',
        'country',
        'draft_year',
        'draft_round',
        'draft_number',
    ];

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'api_team_id', 'api_id');
    }
}
