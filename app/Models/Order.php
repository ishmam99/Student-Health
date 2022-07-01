<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'user_id',
        'tbc_amount',
        'cash_amount',
        'total',
        'item',
        'discount',
        'status',
        'delivered_date',
        'cancel_date',
        'txr_id',
        'payment_method'
    ];

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->hasOne(OrderShip::class);
    }
    /*
        public function returnProduct(){
            return $this->hasMany(ReturnProduct::class);
        }*/
}
