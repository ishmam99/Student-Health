<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WithdrawLimitResource;
use App\Models\WithdrawLimit;
use Illuminate\Http\Request;

class WithdrawLimitController extends Controller
{
   public function index()
   {
       $withdraw_limit = WithdrawLimit::all();
      return $this->apiResponseResourceCollection(200, 'All Withdraw Limits',WithdrawLimitResource::collection($withdraw_limit));
   }

}
