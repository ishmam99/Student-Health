<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invest extends Model
{
    use HasFactory;
    const APPROVE = 1;
    const PENDING = 2;
    const CANCEL = 3;
    const WITHDRAWREQUEST = 1;
    const WITHDRAWAPPROVED = 2;
    const WITHDRAWCANCEL = 3;

    protected $fillable = ['name','status', 'money_return', 'accrual_days', 'amount'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('id', 'is_approved', 'binance_id', 'prove_document', 'withdraw_status', 'profit_amount', 'invest_amount', 'approved_at');
    }
}
