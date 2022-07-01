<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::with('user')->latest()->paginate(10);
        return view('backend.withdraw.index', compact('withdraws'));
    }

    public function update(Request $request, Withdraw $withdraw)
    {
        $user = User::find($withdraw->user_id);
        $user->decrement('balance', $withdraw->amount);
        $user->save();
        $withdraw->update($request->only('status'));
        $message = $withdraw->status == Withdraw::WITHDRAWAPPROVE ? 'Withdraw Request Approve Successfully' : 'Withdraw Request Cancel Successfully';
        return back()->with('success', $message);
    }
}
