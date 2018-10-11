<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address'       => ['required', 'string', 'max:255'],
            'number'        => ['required', 'string'],
            'city'          => ['required', 'string', 'max:255'],
            'zip_code'      => ['required', 'string', 'max:8'],
            'district'      => ['required', 'string', 'max:255'],
            'complement'    => ['string', 'nullable'],
        ];
    }
}
