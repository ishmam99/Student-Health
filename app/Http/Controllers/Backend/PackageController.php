<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(10);
        return view('backend.package.index', compact('packages'));
    }

    public function create()
    {
        return view('backend.package.create');
    }

    public function store(PackageRequest $request)
    {
        $input = $request->validated();
        $input['status'] = $request->status == "on" ? 1 : 0;
        Package::create($input);
        return redirect(route('package.index'));
    }

    public function show(Package $package)
    {
        return view('backend.package.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('backend.package.edit', compact('package'));
    }

    public function update(PackageRequest $request,Package $package)
    {
        $input = $request->validated();
        $input['status'] = $request->status == "on" ? 1 : 0;
        $package->update($input);
        return redirect(route('package.index'));
    }

    public function destroy($id)
    {
        //
    }
}
