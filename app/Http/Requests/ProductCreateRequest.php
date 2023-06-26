<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required||max:10',
            'code' => 'required|unique:products,code',
            'release_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' =>'required|exists:tags,id',
            'price' => 'nullable|sometimes|numeric'
        ];
    }

    public function messages(): array {
        return [
            'category_id.required' => 'The category id is required and must exist in the database.',
            'category_id.exists' => 'category not found.',
            'code.unique' => 'The product code must be unique. The given code already exists.',
            'code.required' => 'The product code is required.',
            'release_date.required' => 'Release date is required.',
            'release_date.date' => 'Invalid date.'
        ];
    }
}
