<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'id' => 'required|exists:products,id',
            'name' => 'sometimes|nullable|max:10|regex:/^[A-Za-z0-9\s*]+$/',
            'code' => 'sometimes|nullable|unique:products,code,except,id|^[A-Za-z0-9\-\_]+$/',
            'release_date' => 'sometimes|nullable|date',
            'category_id' => 'sometimes|nullable|exists:categories,id'
        ];
    }

    public function messages()
{
    return [
        'id.required' => 'The product id is required and must exist in the database.',
        'name.regex' => 'The product name must contain letters/spaces/dashes/underscore (no special symbols).',
        'code.regex' => 'The product code must contain letters/spaces/dashes/underscore (no special symbols).',
        'code.unique' => 'The product code must be unique. The given code already exists.',
    ];
}

}
