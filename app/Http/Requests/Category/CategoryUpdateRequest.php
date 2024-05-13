<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Utilities\ActiveInActiveEnum;


class CategoryUpdateRequest extends FormRequest
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
        request_log(request()->all(), "data to validate for update category");

        return [
            'category' => 'required|integer|exists:categories,id', 
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:' . ActiveInActiveEnum::ACTIVE . "," . ActiveInActiveEnum::INACTIVE,

        ];
    }


    public function messages()
    {
        return [
            'category.required' => 'The category id is not provided with route param',
            'category.integer'  => 'The category is invalid',
            'category.exists'   => 'The category id doesn\'t exist'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'category' => request()->route('category')
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
        response_log($finalResponse, "final response from category edit validation");
        throw new HttpResponseException(response()->json($finalResponse));
    }


}
