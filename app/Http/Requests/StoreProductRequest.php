<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
        return [
            'title' => 'required|string|min:2|max:255|unique:products,title',
            'price' => 'required|string|min:2|max:255',
            'category_id' => 'required|min:1|max:255|exists:categories,id',
            'stock' => 'required|numeric|min:1|max:255',
            'status' => 'required|boolean',
            'variant' => 'required',
            'variant.color' => 'array',
            'variant.size' => 'array',
            'variant.color.*' => 'string|min:2',
            'variant.size.*' => 'string|min:2',
            'description' => 'required|min:5|string',
            'thumbnail' => 'required|min:2',
        ];
    }


    public function messages(): array
    {
        return [
            'variant.array' => 'variant must be object'
        ];
    }
}
