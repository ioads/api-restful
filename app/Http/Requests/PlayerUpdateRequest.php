<?php

namespace App\Http\Requests;

use App\Models\Player;
use Illuminate\Foundation\Http\FormRequest;

class PlayerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('update', Player::class);
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
            'api_team_id' => 'nullable|string',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'position' => 'required|string',
            'height' => 'required|string',
            'weight' => 'required|string',
            'jersey_number' => 'required|string',
            'college' => 'nullable|string',
            'country' => 'required|string',
            'draft_year' => 'nullable|integer',
            'draft_round' => 'nullable|integer',
            'draft_number' => 'nullable|integer',
        ];
    }
}
