<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestCategory extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_category'=>'required|string|min:4|max:20',
            'image' => 'required|image|mimes:jpg,png,gif|max:2700|dimensions:max_width=3840,max_height=2160'
        ];
    }
}
