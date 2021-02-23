<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable =['name', 'description', 'image', 'price', 'bottle_size', 'category_id'];


    /* public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'id');
    } */
    public function category()
    {
        return $this->belongsTo(Category::class, 'gender_id', 'id');
    }



}
