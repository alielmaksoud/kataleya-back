<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'overall_price',
        'shipped_date',
        'order_date',
        'user_id',
        'address'
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

}