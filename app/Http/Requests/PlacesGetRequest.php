<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class PlacesGetRequest extends FormRequest
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
        function integerPositive($name,$number=0)
        {
            $errorMessage = 'O campo ' . $name . ' deve ser um número inteiro e maior ou igual '.$number.').';
            return [
                "nullable",
                "integer",
                function ($attribute, $value, $fail) use ($errorMessage, $number) {
                    if (!is_int(intval($value)) || intval($value) <= $number) {
                        $fail($errorMessage);
                    }
                },
            ];
        }
        $xy = [
            'x' => 'required_with:y',
            'y' => 'required_with:x',
        ];
        function dateRules()
        {
            return [
                'nullable',
                'regex:/^([01]\d|2[0-3]):([0-5]\d)$/',
            ];
        }

        return [
            "x" => array_merge(integerPositive('x', 1),$xy),
            "y" => array_merge(integerPositive('y', 1),$xy),
            "hr" => dateRules(),
            "mts" => integerPositive('mts')
        ];
    }
}
