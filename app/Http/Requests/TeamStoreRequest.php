<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'full_name' => 'required|string',
            'abbreviation' => 'required|string',
            'api_id' => 'nullable|string',
            'conference' => 'nullable|string',
            'division' => 'nullable|string',
            'city' => 'nullable|string',
        ];
    }
}
