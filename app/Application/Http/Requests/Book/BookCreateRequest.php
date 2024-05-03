<?php

namespace App\Application\Http\Requests;

use App\Application\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'value' => 'required|numeric|between:0,999999.99',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'value.required' => 'The value field is required.',
            'value.numeric' => 'The value must be a number.',
            'value.between' => 'The value must be between 0 and 999999.99.',
        ];
    }
}
