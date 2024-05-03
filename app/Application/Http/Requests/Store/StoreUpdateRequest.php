<?php

namespace App\Application\Http\Requests;

use App\Application\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'active' => 'required|boolean',
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

    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'The name may not be greater than 255 characters',
            'address.required'  => 'An address is required',
            'address.max'  => 'The address may not be greater than 255 characters',
            'active.required' => 'The active field is required',
            'active.boolean' => 'The active field must be a boolean value',
        ];
    }
}
