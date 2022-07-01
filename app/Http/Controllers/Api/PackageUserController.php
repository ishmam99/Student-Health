<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPackageRequest;
use App\Http\Resources\PackageHistoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PackageUserController extends Controller
{
    public function store(UserPackageRequest $request)
    {
        $input = $request->validated();
        // if (auth()->user()->subscribePackage()->where('package_id', $input['package_id'])->exists()) return $this->apiResponse(200, 'error', 'Already Send Request');
        $input['prove_document'] = uploadFile($input['prove_document'], '/package');
        auth()->user()->subscribePackage()->attach($input['package_id'], ['prove_document' => $input['prove_document'], 'transaction_id' => $input['transaction_id']]);
        return $this->apiResponse(200, 'success', 'Subscribtion Request Send Successfully');
    }

    public function history(): JsonResponse
    {
        $history = auth()->user()->subscribePackage;
        // dd($history);
        return $this->apiResponseResourceCollection(200, 'Package history', PackageHistoryResource::collection($history));
    }
}
