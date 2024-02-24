<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class passwordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'password'=>'required_with:password_confirmation|min:8|max:30',
            'password_confirm'=>'required|same:password|min:8|max:30'
        ];
    }
}
