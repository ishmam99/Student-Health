<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;
    const ACTIVE = 1;


    protected $fillable = [
        'name',
        'total_id',
        'cost',
        'status',
        'tasks',
        'minimum_withdraw_amount',
        'ads_period_1_price',
        'ads_period_2_price',
        'ads_period_3_price',
        'ads_period_4_price',
    ];

    protected $casts = [
        'club_funds' => 'array'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function userPackage(): HasOne
    {
        return $this->hasOne(PackageUser::class);
    }

    public function subscribePackage(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('id', 'prove_document', 'status');
    }
}
