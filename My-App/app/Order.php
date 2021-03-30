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
        'status_id',
        
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
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}