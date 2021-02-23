<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
            'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            // 'price'=>'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'bottle_size'=>'required|numeric',
            'gender_id'=>'required|integer',
        

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



            'image.required' => 'Image is required!',
            'price.mimes:jpeg,png,jpg,gif,svg|max:2048' => 'Imageshould be in the right format!',

            'bottle_size.required'=>'Bottle size is required',
            'bottle_size.numeric' => 'Bottle Size should be a number!',

            'gender_id.required'=>'Category id id is required',
            'gender_id.integer'=>'Category id should be an integer',
            
            
            // 'overall_price.regex:/^\d*(\.\d{2})?$/' => 'Price not in correct format',

        ];
    }
}