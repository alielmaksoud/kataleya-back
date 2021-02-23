<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
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
            // 'item' => 'required|min:3|max:255',
            'quantity' => 'required|integer|min:1|max:100',
            'price'=>'required|numeric',
            // 'price'=>'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'order_id'=>'required|integer',
            'item_id'=>'required|integer',

        ];
    }
    public function messages()
    {
        return [
            // 'item.required' => 'Item is required!',
            // 'item.min:3'=>'name cannot be less than three letters',
            // 'item.max:255'=>"Exceeded space allowed",

            'quantity.required' => 'Quantity is required!',
            'quantity.min:1'=>"the quantity shouldn't be less than 1",
            'quantity.max:100'=>"Exceeded max quantity allowed",

            'price.required' => 'Price is required!',
            'price.numeric' => 'Price should be a number!',

            'order_id.required'=>'Order id is required',
            'order_id.integer'=>'Order id should be an integer',

            'item_id.required'=>'Item id is required',
            'item_id.integer'=>'Item id should be an integer',

            // 'overall_price.regex:/^\d*(\.\d{2})?$/' => 'Price not in correct format',

        ];
    }
}