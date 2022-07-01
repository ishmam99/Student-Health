<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DivisionResource;
use App\Models\Division;

class LocationController extends Controller
{
    public function location()
    {
        return (DivisionResource::collection(Division::all()))->response();
    }
}
