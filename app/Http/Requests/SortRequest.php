<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
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
            'list' => [
                'required',
                function ($attribute, $value, $fail) {
            var_dump($value);
                    if (!is_array($value)) {
                        $fail('O campo list deve ser um array de números');
                    }
                    foreach ($value as $item) {
                        if (!is_numeric($item)) {
                            $fail('Os elementos do array list devem ser números.');
                        }
                    }
                },
            ],
        ];
    }
}
