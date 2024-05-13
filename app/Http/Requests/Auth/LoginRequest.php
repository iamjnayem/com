<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
        request_log("data to validate for login", request()->all());

        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }



    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     * 
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();        
        $finalResponse = error_response(null, $errors, 422);
        response_log("final response from login validation", $finalResponse);
        throw new HttpResponseException(response()->json($finalResponse));
    }
}
