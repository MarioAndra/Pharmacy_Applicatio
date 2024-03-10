<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required_with:password_confirmation|min:8|max:30'
        ];
    }
}
