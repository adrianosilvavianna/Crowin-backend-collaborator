<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf'               => ['required', 'string'],
            'phone'             => ['required', 'string'],
            'age'               => ['nullable', 'numeric'],
            'gender'            => ['nullable', 'boolean'],
            'photo_address'     => ['nullable', 'string'],
            'about'             => ['nullable', 'string']
        ];
    }
}