<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'bn_name',
        'url'
    ];

    public function Districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
