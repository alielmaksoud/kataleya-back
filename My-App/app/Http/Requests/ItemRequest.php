<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'price'=>'required|numeric',
            'offer_price'=>'required|numeric',
            'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            // 'price'=>'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'bottle_size'=>'required|numeric',
            'category_id'=>'required|integer',
            'is_offer'=>'required|boolean'

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.min:3'=>'Name cannot be less than three letters',
            'name.max:255'=>"Exceeded space allowed",

            'description.required' => 'Quantity is required!',
            'description.max:500'=>'Exceeded space allowed',

            'price.required' => 'Price is required!',
            'price.numeric' => 'Price should be a number!',

            'offer_price.required' => 'Offer Price is required!',
            'offer_price.numeric' => 'Offer Price should be a number!',

            'image.required' => 'Image is required!',
            'price.mimes:jpeg,png,jpg,gif,svg|max:2048' => 'Imageshould be in the right format!',

            'bottle_size.required'=>'Bottle size is required',
            'bottle_size.numeric' => 'Bottle Size should be a number!',

            'category_id.required'=>'Category id id is required',
            'category_id.integer'=>'Category id should be an integer',
            
            'is_offer.required'=>'This should be required',
            'is_offer.boolean' => 'This should be true, false, 0, or 1',
            
            // 'overall_price.regex:/^\d*(\.\d{2})?$/' => 'Price not in correct format',

        ];
    }
}