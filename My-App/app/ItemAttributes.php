<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAttributes extends Model
{
    protected $fillable=['item_id', 'bottle_size', 'price', 'offer_price'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
