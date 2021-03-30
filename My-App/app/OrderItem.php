<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=['item_id', 'order_id', 'quantity',
    //  'item',
      'price',"bottle_size",'name','image'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}