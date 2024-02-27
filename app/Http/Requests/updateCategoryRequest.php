<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCategoryRequest extends FormRequest
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
            'name_category'=>'nullable|string|min:4|max:20',
            'parent_id'=>'nullable',
            'image' => 'nullable|image|mimes:jpg,png,gif|max:2764800|dimensions:max_width=3840,max_height=2160'
        ];
    }
}
