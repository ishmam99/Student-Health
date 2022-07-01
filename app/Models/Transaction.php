<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    const STATUS_CREDITED = 0;
    const STATUS_DEBITED = 1;

    const TYPE_REFERRAL_BONUS = 0;
    const TYPE_GENERATION_INCOME = 1;
    const TYPE_PACKAGE_MIGRATION_COST = 2;
    const TYPE_VIDEO_WATCH_BONUS = 3;
    const TYPE_CREDITED_BY_ADMIN = 4;
    const TYPE_BALANCE_TRANSFER_BY_USER = 5;
    const TYPE_WITHDRAW_BALANCE = 6;
    const TYPE_INVEST = 7;
    const PACKAGEAPPROVE = 8;

    protected $guarded = [];

    public static function newTransaction(int $user_id, int $transactionType, int $transactionStatus, $amount = 0, $method = null): Transaction
    {
        return self::create([
            'user_id' => $user_id,
            'transaction_id' => Str::uuid(),
            'amount' => $amount,
            'method' => $method,
            'type' => $transactionType,
            'status' => $transactionStatus
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAuthUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public static function sumOf(int $type, $all = FALSE, $status = self::STATUS_CREDITED)
    {
        return self::where('type', $type)
            ->when(!$all, fn ($query) => $query->whereDate('created_at', now()->toDateString()))
            ->where('status', $status)
            ->authUser()
            ->sum('amount');
    }
}
