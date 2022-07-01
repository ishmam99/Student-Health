<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package_id',
        'club_id',
        'rank_id',
        'referred_by',
        'balance',
        'shopping_balance',
        'name',
        'uid',
        'phone',
        'email',
        'image',
        'country',
        'password',
        'status',
        'account_expire_on',
        'level',
        'binance_id',
        'referral_balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'account_expire_on' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_picture')->singleFile();
    }

    public function referredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function refers(): HasMany
    {
        return $this->hasMany(User::class, 'referred_by', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function Withdraws(): HasMany
    {
        return $this->hasMany(Withdraw::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function watchedVideos(): hasmany
    {
        return $this->hasMany(WatchedVideo::class);
    }

    public function videoWatchedToday(): HasMany
    {
        return $this->hasMany(WatchedVideo::class)->whereDate('created_at', now()->toDateString());
    }

    public function invests(): BelongsToMany
    {
        return $this->belongsToMany(Invest::class)->withTimestamps()->withPivot('id', 'is_approved', 'withdraw_status', 'profit_amount', 'prove_document', 'invest_amount', 'approved_at');
    }
    
    public function subscribePackage(): BelongsToMany
    {
        return $this->belongsToMany(Package::class)->withTimestamps()->withPivot('id', 'prove_document', 'status', 'transaction_id');
    }
}
