<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrimoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'number' => ['required',
                function ($attribute, $value, $fail) {
                    if (!is_int($value) && !is_array($value)) {
                        $fail('O campo numbers deve ser um número inteiros ou um array de números inteiros.');
                    }
                    if (is_array($value)) {
                        foreach ($value as $item) {
                            if (!is_int($item)) {
                                $fail('Os elementos do array numbers devem ser números inteiros.');
                            }
                        }
                    }
                },
            ],
        ];
    }
}
