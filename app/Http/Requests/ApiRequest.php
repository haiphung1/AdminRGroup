<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $errorsList = $validator->errors()->toArray();
        $errors = [];

        foreach ($errorsList as $key => $messages) {
            $errors[$key] = $messages[0];
        }

        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Invalid',
            'errors'  => $errors
        ], 400));
    }
}
