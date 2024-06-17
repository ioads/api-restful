<?php

namespace App\Http\Requests;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;

class GameStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('create', Game::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'api_id' => 'required|string',
            'api_home_team_id' => 'required|string',
            'api_visitor_team_id' => 'required|string',
            'date' => 'required|date',
            'season' => 'required|integer',
            'status' => 'required|string',
            'period' => 'required|integer',
            'time' => 'required|string',
            'postseason' => 'required|boolean',
            'home_team_score' => 'required|integer',
            'visitor_team_score' => 'required|integer',
        ];
    }
}
