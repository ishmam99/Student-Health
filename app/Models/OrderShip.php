<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderShip extends Model
{
    protected $table = 'order_ships';
    protected $fillable = [
        'order_id',
        'user_id',
        'mobile',
        'division',
        'district',
        'thana',
        'address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
