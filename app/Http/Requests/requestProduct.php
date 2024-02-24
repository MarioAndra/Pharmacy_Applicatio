<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestProduct extends FormRequest
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
            'name_product'=>'required|min:2|max:15',
            'price'=>'required|numeric|min:100',
            'category_id'=>'required',
            'user_id'=>'required',
            'images' => 'required|array|min:2',
            'images.*' => 'required|image|mimes:jpg,png,gif|max:2700|dimensions:max_width=3840,max_height=2160'
        ];
    }
}
