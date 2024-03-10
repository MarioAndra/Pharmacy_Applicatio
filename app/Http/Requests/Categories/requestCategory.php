<?php

namespace App\Http\Requests\categories;

use Illuminate\Foundation\Http\FormRequest;

class requestCategory extends FormRequest
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
            'name_category'=>'nullable|string|min:4|max:20',
            'parent_id'=>'nullable',
            'image' => 'nullable|image|mimes:jpg,png,gif|max:2765|dimensions:max_width=3840,max_height=2160'
        ];
    }
}
