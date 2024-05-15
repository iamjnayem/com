<?php

namespace App\Http\Requests\Unit;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Utilities\ActiveInActiveEnum;

class UnitEditRequest extends FormRequest
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
        request_log(request()->all(), "data to validate for unit");
        return [
            'unit' => 'required|integer|exists:units,id', 

        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'unit' => request()->route('unit')
        ]);
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
        response_log($finalResponse, "final response from unit validation");
        throw new HttpResponseException(response()->json($finalResponse));
    }
}
