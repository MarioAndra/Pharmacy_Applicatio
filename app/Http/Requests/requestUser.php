<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestUser extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [

            'name'=>'required|string|min:3|max:15',
            'email'=>'required|email',
            'number'=>'required|between:10,10',
            'image' => 'required|image|mimes:jpg,png,gif|max:2700|dimensions:max_width=3840,max_height=2160|'

        ];

    }

}
