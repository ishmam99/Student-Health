<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdraw extends Model
{
    use HasFactory;
    const WITHDRAWPENDING = 0;
    const WITHDRAWAPPROVE = 1;
    const WITHDRAWCANCEL = 2;
    protected $fillable = [
        'user_id',
        // 'transaction_id',
        'binance_id',
        'amount',
        'shopping_balance',
        'after_cost_amount',
        'method',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
}
