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
            
            'quantity' => '|integer|min:1|max:100',
            'cart_id'=>'required|integer',
            'item_id'=>'required|integer',

        ];
    }
    public function messages()
    {
        return [

           
            'quantity.max:100'=>"Exceeded max quantity allowed",
            'quantity.min:1'=>"Exceeded minimum quantity allowed",
            
            'cart_id.required'=>'Cart id is required',
            'cart_id.integer'=>'Cart id should be an integer',

            'item_id.required'=>'Item id is required',
            'item_id.integer'=>'Item id should be an integer',
            

        ];
    }
}