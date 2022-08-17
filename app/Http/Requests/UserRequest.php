<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'data*.name'            => 'required',
            'data*.gender'          => 'in:male,female,others',
            'data*.address'         => 'required',
            // 'data*.mobile_number'   => 'required|array',
            'data*.mobile_number' => 'required|regex:/9[6-8]{1}[0-9]{8}/',
            // 'data*.mobile_number.*' => 'required|numeric|regex:/9[6-8]{1}[0-9]{8}/|digits:10|distinct|unique:users',
            'data*.password'        => 'required|min:8|max:20|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,20})/|confirmed',
            'data*.email'           => 'required|email|unique:users',
            'data*.type'            => 'required|in:individual,corporate',
            'data*.pan_number'      => 'required_with:type,corporate|min:8|max:10',
            'pan_document'          => 'required_with:type,corporate|mimes:jpg,jpeg,png|max:2048',
            'profile_image'         => 'mimes:jpg,jpeg,png|max:2048',
        ];
    }
}

