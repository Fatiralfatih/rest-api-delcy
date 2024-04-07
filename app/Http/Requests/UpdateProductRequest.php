<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductRequest extends FormRequest
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
            'title' => ' nullable|min:2|max:255|unique:products,title',
            'price' => 'required|min:2|string|max:255',
            'category_id' => 'required|min:1|exists:categories,id',
            'stock' => 'required|string|min:2|max:255',
            'status' => 'required|boolean',
            'variant.color' => 'array',
            'variant.size' => 'array',
            'variant.color.*' => 'required|min:2|string|max:255',
            'variant.size.*' => 'required|min:2|string|max:255',
            'description' => 'required|min:10|string|max:255',
        ];
    }

}
