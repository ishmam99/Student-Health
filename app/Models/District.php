<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'division_id',
        'name',
        'bn_name',
        'lat',
        'lon',
        'url'
    ];

    public function Division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function Upazilas(): HasMany
    {
        return $this->hasMany(Upazila::class);
    }
}
