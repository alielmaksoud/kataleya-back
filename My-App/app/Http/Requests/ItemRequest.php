<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'description' => 'required|max:500',

            'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'price'=>'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'category_id'=>'required|integer',
            'is_offer'=>'boolean',
            'is_featured'=>'boolean'   

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.min:3'=>'Name cannot be less than three letters',
            'name.max:255'=>"Exceeded space allowed",

            'description.required' => 'Description is required!',
            'description.max:500'=>'Exceeded space allowed',


            'image.required' => 'Image is required!',
            'image.mimes:jpeg,png,jpg,gif,svg|max:2048' => 'Imageshould be in the right format!',

          

            'category_id.required'=>'Category id id is required',
            'category_id.integer'=>'Category id should be an integer',
            
            // 'is_offer.required'=>'This should be required',
            'is_offer.boolean' => 'This should be true, false, 0, or 1',
            
            // 'is_featured.required'=>'This should be required',
            'is_featured.boolean' => 'This should be true, false, 0, or 1',
            // 'overall_price.regex:/^\d*(\.\d{2})?$/' => 'Price not in correct format',

        ];
    }
}