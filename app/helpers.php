<?php

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

function isActive($path, $active = 'active menu-open')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function uploadFile($file, $folder = '/'): ?string
{
    if ($file) {
        $image_name = Rand() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $image_name, 'public');
    }
    return null;
}

function setImage($url = null, $type = null, $default_image = true): string
{
    if ($type == 'user') {
        return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_user.png') : '');
    }
    return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_image.png') : '');
}

function apiResponse(int $statusCode, string $statusMessage, $data = []): JsonResponse
{
    return (new Controller())->apiResponse($statusCode, $statusMessage, $data);
}

function dateFormat(Carbon $carbon): string
{
    return (new Controller())->dateFormat($carbon);
}

function daysCount($startday = null)
{
    $start = Carbon::parse($startday);
    $now = Carbon::now();
    return $start->diffInDays($now);
}
 
 function en2bn($number) {
    static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0"); 
        return str_replace($en,$bn, $number);
        }
function bn2en($number)
{
    static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    return str_replace($bn, $en, $number);
}
