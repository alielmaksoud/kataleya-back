<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
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
            'date_added'=>'required|date_format:Y/m/d',
            'quantity' => 'required|integer|min:1|max:100',
            'cart_id'=>'required|integer',
            'item_id'=>'required|integer',

        ];
    }
    public function messages()
    {
        return [

            'quantity.required' => 'Quantity is required!',
            'quantity.min:1'=>"the quantity shouldn't be less than 1",
            'quantity.max:100'=>"Exceeded max quantity allowed",

            'date_added.required' => 'Date is required!',
            'date_added.date_format:Y/m/d' => 'Date not in correct format',

            'cart_id.required'=>'Cart id is required',
            'cart_id.integer'=>'Cart id should be an integer',

            'item_id.required'=>'Item id is required',
            'item_id.integer'=>'Item id should be an integer',
            

        ];
    }
}