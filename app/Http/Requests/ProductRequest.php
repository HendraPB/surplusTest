<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'categories' => "array",
            'categories.*.name' => "required_with:categories",
            'images' => "array",
            'images.*.name' => 'required_with:images',
            'images.*.file' => 'required_with:images|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
