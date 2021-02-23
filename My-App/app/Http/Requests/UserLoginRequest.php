<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
           
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.email' => 'Email format wrong',
            'email.required'=>'Email is missing',
            'password.required'=>'Password is missing',
            'password.min:6' => 'Password is too short',
            
        ];
    }
}