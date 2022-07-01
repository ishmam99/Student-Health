<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfitInvestResource;
use App\Models\Invest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function withdrawAndTransferReport(): JsonResponse
    {
        return $this->apiResponse(200, 'success','Withdraw & transfer report.', ['data' => [
            'total_balance'  => Auth::user()->balance,
            'total_withdraw' => Transaction::sumOf(Transaction::TYPE_WITHDRAW_BALANCE, TRUE, Transaction::STATUS_DEBITED),
            'total_transfer' => Transaction::sumOf(Transaction::TYPE_BALANCE_TRANSFER_BY_USER, TRUE, Transaction::STATUS_DEBITED),
        ]]);
    }

    public function joiningBalanceReport(): JsonResponse
    {
        return $this->apiResponse(200, 'success','Joining balance report.', ['data' => [
            'in_from_admin'    => Transaction::sumOf(Transaction::TYPE_CREDITED_BY_ADMIN, TRUE),
            'in_from_user'     => Transaction::sumOf(Transaction::TYPE_BALANCE_TRANSFER_BY_USER, TRUE),
            'joining_expense'  => Transaction::sumOf(Transaction::TYPE_PACKAGE_MIGRATION_COST, TRUE, Transaction::STATUS_DEBITED),
            'balance_transfer' => Transaction::sumOf(Transaction::TYPE_BALANCE_TRANSFER_BY_USER, TRUE, Transaction::STATUS_DEBITED),
        ]]);
    }

    public function incomeStatementReport(): JsonResponse
    {
        return $this->apiResponse(200,'success', 'Income statement report.', ['data' => [
            'referred_income'            => round(Transaction::sumOf(Transaction::TYPE_REFERRAL_BONUS, TRUE),2),
            'video_watch_income'         =>round( Transaction::sumOf(Transaction::TYPE_VIDEO_WATCH_BONUS, TRUE),2),
            'generation_income'          => round(Transaction::sumOf(Transaction::TYPE_GENERATION_INCOME, TRUE),2),
            'purchase_commission_income' => 0,
            'total_shopping_balance'     => (int)Auth::user()->shopping_balance,
            'total_balance'              => (int)Auth::user()->balance,
        ]]);
       
    }

    public function rankGalleryReport(): JsonResponse
    {
        return $this->apiResponse(200,'success', 'Rank gallery report.', ['data' => [
            'bronze_members'   => 0,
            'silver_members'   => 0,
            'gold_members'     => 0,
            'platinum_members' => 0,
            'crown_members'    => 0,
            'agm_members'      => 0,
        ]]);
    }

    public function generationLine(): JsonResponse
    {
        return $this->apiResponse(200,'success', 'Generation line report.', ['data' => [
            'generation_1'  => User::where('count_referred_user', 1)->count(),
            'generation_2'  => User::where('count_referred_user', 2)->count(),
            'generation_3'  => User::where('count_referred_user', 3)->count(),
            'generation_4'  => User::where('count_referred_user', 4)->count(),
            'generation_5'  => User::where('count_referred_user', 5)->count(),
            'generation_6'  => User::where('count_referred_user', 6)->count(),
            'generation_7'  => User::where('count_referred_user', 7)->count(),
            'generation_8'  => User::where('count_referred_user', 8)->count(),
            'generation_9'  => User::where('count_referred_user', 9)->count(),
            'generation_10' => User::where('count_referred_user', 10)->count(),
            'generation_11' => User::where('count_referred_user', 11)->count(),
            'generation_12' => User::where('count_referred_user', 12)->count(),
            'generation_13' => User::where('count_referred_user', 13)->count(),
            'generation_14' => User::where('count_referred_user', 14)->count(),
            'generation_15' => User::where('count_referred_user', 15)->count(),
            'generation_16' => User::where('count_referred_user', 16)->count(),
            'generation_17' => User::where('count_referred_user', 17)->count(),
            'generation_18' => User::where('count_referred_user', 18)->count(),
            'generation_19' => User::where('count_referred_user', 19)->count(),
            'generation_20' => User::where('count_referred_user', 20)->count(),
        ]]);
    }

    public function userInvest(): JsonResponse
    {
        $invests = auth()->user()->invests()->where('withdraw_status', Invest::WITHDRAWAPPROVED)->get();
        return $this->apiResponseResourceCollection(200, 'Pending Request List', ProfitInvestResource::collection($invests));
        // $invests = $this->pivotUserInvestList(DB::table('user_invest')->whereIn('is_approved', [Invest::PENDING, Invest::CANCEL]));
    }
}
