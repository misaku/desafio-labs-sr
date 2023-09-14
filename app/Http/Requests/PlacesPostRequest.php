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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        function integerPositive($name)
        {
            $errorMessage = 'O campo ' . $name . ' deve ser um número inteiro e positivo(>=0).';
            return [
                "required",
                "integer",
                function ($attribute, $value, $fail) use ($errorMessage) {
                    if (!is_int($value) || $value <= 0) {
                        $fail($errorMessage);
                    }
                },
            ];
        }

        function dateRules()
        {
            return [
                'nullable',
                'regex:/^([01]\d|2[0-3]):([0-5]\d)$/',
                'opened' => 'required_with:closed',
                'closed' => 'required_with:opened',
            ];
        }

        return [
            "name" => "required|max:50",
            "x" => integerPositive('x'),
            "y" => integerPositive('y'),
            "opened" => dateRules(),
            "closed" => dateRules()
        ];
    }
}
