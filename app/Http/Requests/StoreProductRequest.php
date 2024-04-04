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
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|numeric',
            'status' => 'nullable',
            'variant' => 'required',
            'variant.color' => 'array',
            'variant.size' => 'array',
            'variant.color.*' => 'string',
            'variant.size.*' => 'string',
            'description' => 'required|string',
            'thumbnail' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'status' => 'failed',
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422));
    }

    public function messages(): array
    {
        return [
            'variant.array' => 'variant must be object'
        ];
    }
}
