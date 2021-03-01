<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable=['status'];

    public function order()
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }
}
