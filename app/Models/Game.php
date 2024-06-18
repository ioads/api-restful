<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_id',
        'api_home_team_id',
        'api_visitor_team_id',
        'date',
        'season',
        'status',
        'period',
        'time',
        'postseason',
        'home_team_score',
        'visitor_team_score'
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'api_home_team_id', 'api_id');
    }

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'api_visitor_team_id', 'api_id');
    }
}
