<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =['name', 'description', 'image', 'price', 'offer_price', 'bottle_size', 'is_offer', 'is_featured', 'category_id'];

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'id');
    }
    public function cartItem()
    {
        return $this->hasMany(CartItem::class, 'item_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
