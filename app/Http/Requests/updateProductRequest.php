<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>'nullable|min:2|max:15',
            'price'=>'nullable|numeric|min:100',
            'category_id'=>'nullable',
            'user_id'=>'nullable',
            'images' => 'nullable|array|min:2',
            'images.*' => 'nullable|image|mimes:jpg,png,gif|max:2764800|dimensions:max_width=3840,max_height=2160'
        ];
    }
}
