<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestCreateProduct extends FormRequest
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
            'name_product'=>'required|min:2|max:20',
            'price'=>'required|numeric|min:100',
            'category_id'=>'required',
            'user_id'=>'required'
        ];
    }
}
