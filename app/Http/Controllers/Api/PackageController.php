<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageDetailsResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\SinglePackageResource;
use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() : JsonResponse
    {
        $packages = Package::where('status', Package::ACTIVE)->get();
        return $this->apiResponseResourceCollection(200, 'All packages', PackageResource::collection($packages));
    }

    public function create()
    {
    }

    public function store(PackageRequest $request)
    {
        
    }

    public function show(Package $package)
    {
      //  dd($package);
        return $this->apiResponseResourceCollection(200, ' Package Details', PackageDetailsResource::make($package));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
