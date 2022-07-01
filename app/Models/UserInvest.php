<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'invest_id',
    ];
}
