<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'overall_price'=>'required|numeric',
            // 'overall_price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'order_date'=>'required|date_format:Y/m/d',
            'shipped_date'=>'after_or_equal:order_date|date_format:Y/m/d',
            // 'user_id'=>'required|integer',
            'address'=>'required|min:10|max:255'
        ];
    }
    public function messages()
    {
        return [
            'overall_price.required' => 'Price is required!',
            // 'overall_price.regex:/^\d*(\.\d{2})?$/' => 'Price not in correct format',
            'overall_price.numeric' => 'Price should be a number!',

            'order_date.required' => 'Order date is required!',
            'order_date.date_format:Y/m/d' => 'Order date not in correct format',

            'shipped_date.required' => 'Shipping date is required!',
            'shipped_date.date_format:Y/m/d' => 'Shipping date not in correct format',
            'shipped_date.after_or_equal:order_date' => 'Shipping Date should be after an Order date',

            // 'user_id.required'=>'Customer id is required',
            // 'user_id.integer'=>'Customer id should be an integer',

            'address.required'=>'Address is required',
            'address.min:10'=>'Adress cannot be less than 10 letters',
            'address.max:255'=>'Exceeded space allowed',
            
        ];
    }
}