<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'name' => 'required|between:2,100',
            'email' => 'required|email|unique:admins|max:50',
            'password' => 'required|confirmed|string|min:6',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Your Name is Required!',
            'email.required'=>'An email is required!',
            'password.required'=>'A password is required!',
            
        ];
    }
}