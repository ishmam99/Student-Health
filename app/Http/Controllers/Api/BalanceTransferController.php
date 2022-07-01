<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BalanceTransferController extends Controller
{
    public function balanceTransferToUser(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'uid'      => ['required', Rule::exists('users', 'uid')],
            'amount'   => ['required', 'numeric'],
            'password' => ['required', 'string'],
        ]);

        if (!Hash::check($request->input('password'), Auth::user()->password)) {
            return $this->apiResponse(422, 'The provided credentials are incorrect.');
        }
        if (Auth::user()->balance < $request->input('amount')) {
            return $this->apiResponse(422, 'Insufficient balance.');
        }

        DB::transaction(function () use ($validated) {
            $receiver = User::where('uid', $validated['uid'])->first();
            $receiver->increment('balance', $validated['amount']);
            Auth::user()->decrement('balance', $validated['amount']);

            $transactionType = Transaction::TYPE_BALANCE_TRANSFER_BY_USER;
            Transaction::newTransaction($receiver->id, $transactionType, Transaction::STATUS_CREDITED, $validated['amount']);
            Transaction::newTransaction(Auth::id(), $transactionType, Transaction::STATUS_DEBITED, $validated['amount']);
        });

        return $this->apiResponse(200, 'Balance Transferred.');
    }
}
