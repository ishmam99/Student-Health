<?php

namespace App\Http\Controllers\Api;

use App\Models\Objection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ObjectionController extends Controller
{
    public function create(Request $request)
    {
        $input = $request->all();
        $input['user_id']= auth()->user()->id;
        Objection::create($input);
        return $this->apiResponse(200, 'success', 'Objection Posted Successfully');
    }
}
