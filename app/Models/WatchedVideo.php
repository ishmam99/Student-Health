<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchedVideo extends Model
{
    use HasFactory;
    const ADSENCE = 'Adsence', UNITY = 'UnityAds', MEDIA = 'Media.net', CAPCHA = '2Captcha', MEGATYPE = 'Megatypers', ADSTERRA = 'Adsterra';
    const ADSPERIOD1 = 1, ADSPERIOD2 = 2, ADSPERIOD3 = 3, ADSPERIOD4 = 4, ADSMAXDAYS = 50;
    protected $fillable = [
        'user_id',
        'watched_count',
        'package',
        'task_id',
        'ads_type',
        'period'
    ];

}
