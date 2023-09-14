<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PlacesPostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'x' => ['required_with:y', 'integer', 'min:1'],
            'y' => ['required_with:x', 'integer', 'min:1'],
            'opened' => ['required_with:closed', 'date_format:H:i'],
            'closed' => ['required_with:opened', 'date_format:H:i'],
        ];
    }
}
