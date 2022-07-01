<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Http\Resources\WithdrawResource;
use App\Models\UserInvest;
use App\Models\Withdraw;
use App\Models\WithdrawLimit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function history(): JsonResponse
    {
        return $this->apiResponseResourceCollection(
            200,
            'Withdraw history.',
            WithdrawResource::collection(Auth::user()->withdraws)
        );
    }

    public function store(WithdrawRequest $request)
    {
        $input=$request->validated();
        $message = '';
        if (auth()->user()->balance < 500) $message = 'insufficient balance.'; 
        else {
            $input['user_id'] = auth()->user()->id;
            $withdraw = Withdraw::create($input);
            $message = 'Withdraw Request ' . $withdraw->amount . ' tk To admin Successfully';
        }
        return $this->apiResponse(201,'success', strtoupper($message));
    }

    


    // public function store(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'amount'   => ['required', 'string'],
    //         'method'   => ['required', 'string'],
    //         'password' => ['required', 'string'],
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->apiResponse(422, 'The given data was invalid.', ['errors' => $validator->errors()]);
    //     }
    //     if (!Hash::check($request->input('password'), Auth::user()->password)) {
    //         return $this->apiResponse(422, 'The provided credentials are incorrect.');
    //     }
    //     if (Auth::user()->package->minimum_withdraw_amount > $request->input('amount')) {
    //         return $this->apiResponse(422, 'Minimum withdraw amount ' . Auth::user()->package->minimum_withdraw_amount . 'TK');
    //     }
    //     if (Auth::user()->balance < $request->input('amount')) {
    //         return $this->apiResponse(422, 'Insufficient balance.');
    //     }

    //     $validated = $validator->validated();
    //     $validated['shopping_balance'] = ($validated['amount'] / 100) * 40; //40
    //     $after_shopping_balance_cut = $validated['amount'] - $validated['shopping_balance']; //60
    //     $cost = ($after_shopping_balance_cut / 100) * 15; //9
    //     $validated['after_cost_amount'] = $after_shopping_balance_cut - $cost; //51

    //     auth()->user()->withdraws()->create($validated);
    //     auth()->user()->decrement('balance', $request->input('amount'));

    //     return $this->apiResponse(201, 'Withdraw request send.');
    // }
}
