<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPackageRequest;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageUserController extends Controller
{
    public function index()
    {
        $allSubscribers = User::whereRelation('subscribePackage', 'package_user.status', PackageUser::PENDING)
            ->with('subscribePackage', fn ($query) => $query->where('package_user.status', PackageUser::PENDING))->paginate(10);
        return view('backend.user-package.index', compact('allSubscribers'));
    }

    public function accept()
    {
        $allSubscribers = User::whereHas(
            'subscribePackage',
            fn ($query) => $query->whereIn('package_user.status', [PackageUser::APPROVE, PackageUser::CANCEL])
        )
            ->with(
                'subscribePackage',
                fn ($query) => $query->whereIn('package_user.status', [PackageUser::APPROVE, PackageUser::CANCEL])
            )
            ->paginate(10);
        return view('backend.user-package.accept-list', compact('allSubscribers'));
    }

    public function update(Request $request, $id)
    {
        $data = User::whereRelation('subscribePackage', 'package_user.id', $id)
            ->with('subscribePackage', fn ($query) => $query->where('package_user.id', $id))->first();
        $packageUser = $data->subscribePackage->first();
        $packageUser->pivot->status = $request->is_approved;
        if ($packageUser->pivot->status == PackageUser::APPROVE) {
            if ($data->referred_by){
                $data->referredBy->increment('balance', ($packageUser->cost / 100) * 1);
                $data->referredBy->increment('referral_balance', ($packageUser->cost / 100) * 1);
            } 
            $data->package_id = $packageUser->id;
            $data->save();
        }
        $packageUser->pivot->save();
        return back()->with('success', $packageUser->pivot->status == PackageUser::APPROVE ? 'User ' . $data->name . ' Request Approve' : 'User Request Cancel');
    }
}
