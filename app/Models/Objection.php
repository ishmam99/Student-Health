<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Objection extends Model
{
    use HasFactory;

    const PENDING = 0, APPROVE = 1, CANCEL = 2;

    protected $fillable = ['user_id', 'objection', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
