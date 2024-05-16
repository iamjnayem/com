<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductStoreRequest extends FormRequest
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
        request_log(request()->all(), "data to validate for product");
  
        return [
            'name'        => 'required|string|max:255|unique:products,name',
            'description' => 'required|string|max:1000',
            'variations'  => 'required|array',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id'
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
        response_log($finalResponse, "final response from product validation");
        throw new HttpResponseException(response()->json($finalResponse));
    }
}
