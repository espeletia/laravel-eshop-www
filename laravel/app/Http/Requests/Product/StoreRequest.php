<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'description' => 'required|string|max:6000',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'featured_image' => 'required|image|max:10240000000000000000|mimes:jpg,jpeg,png',
        ];
    }
}
