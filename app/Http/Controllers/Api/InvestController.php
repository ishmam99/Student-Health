<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvestDetailsResource;
use App\Http\Resources\InvestResource;
use App\Models\Invest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Invest::all();
        
        return $this->apiResponseResourceCollection(200, 'All invests', InvestResource::collection($data));
    }

    public function show(Invest $invest)
    {
        return $this->apiResponseResourceCollection(200, ' Package Details', InvestDetailsResource::make($invest));
    }
}
