<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>'nullable|string|min:3|max:15',
            'email'=>'nullable|email',
            'number'=>'nullable|between:10,10',
            'image' => 'nullable|image|mimes:jpg,png,gif|max:2764800|dimensions:max_width=3840,max_height=2160|'
        ];
    }
}
