<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upazila extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'district_id',
        'name',
        'bn_name',
        'url'
    ];

    public function District(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
