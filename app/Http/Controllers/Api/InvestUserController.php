<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestUserRequest;
use App\Http\Resources\PendingInvestResource;
use App\Http\Resources\UserInvestApproveResource;
use App\Http\Resources\UserInvestResource;
use App\Models\Invest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestUserController extends Controller
{
    public function __construct(Invest $invest)
    {
        $this->invest = $invest;
    }

    public function store(InvestUserRequest $request): JsonResponse
    {
        $input = $request->validated();
        $input['prove_document'] = uploadFile($input['prove_document'], '/invest');
        $input['is_approved'] = Invest::PENDING;
        $data = auth()->user()->invests()->attach($request->invest_id, $input);
        return $this->apiResponse(200, 'success', 'Invest Request Successfully', $data);
    }

    public function acceptInvestRequest(Request $request, $id)
    {
        DB::table('invest_user')->whereId($id)->update(['approve' => Invest::APPROVE]);
        return $this->apiResponse(200, 'success', 'Update Invest Request');
    }

    public function adminPendingList()
    {
        $list = DB::table('invest_user')->join('invests', 'invests.id', 'invest_user.invest_id')->join('users', 'users.id', 'invest_user.user_id')->where('approve', Invest::PENDING)->get();
        return $this->apiResponseResourceCollection(200, 'Pending Request List', PendingInvestResource::collection($list));
    }

    public function index(): JsonResponse
    {
        $invests = auth()->user()->invests()->get();
        // dd($invests);

        return $this->apiResponseResourceCollection(
            200,
            'Invest History List',
            UserInvestResource::collection($invests)
        );
    }

    public function approve(): JsonResponse
    {
        // $invests = auth()->user()->invests()->get();
        $invests = $this->pivotUserInvestList(DB::table('invest_user')->whereIn('is_approved', [Invest::APPROVE]));
        return $this->apiResponseResourceCollection(
            200,
            'Invest History List',
            UserInvestApproveResource::collection($invests)
        );
    }

    public function withdrawInvestRequest(Request $request, $id): JsonResponse
    {
        $withdrawInvest = DB::table('invest_user')->where('invest_user.id', $id)->join('invests', 'invest_user.invest_id', '=', 'invests.id')->first();
        if ($withdrawInvest->accrual_days < daysCount($withdrawInvest->approved_at)) {
            DB::table('invest_user')->whereId($id)->update(['withdraw_status' => Invest::WITHDRAWREQUEST, 'binance_id' => $request->input('binance_id')]);
            return $this->apiResponse(200, 'success', 'Withdraw Request Successfully');
        } else return $this->apiResponse(200, 'error', 'Invalid Request');
    }

    public function upgradeInvest(Request $request)
    {
        $input = $request->all();
        $invest = Invest::find($request->invest_id);
        $input['prove_document'] = uploadFile($input['prove_document'], '/invest');
        $data = auth()->user()->invests()->attach($request->invest_id, ['prove_document' => $input['prove_document'], 'is_approved' => Invest::PENDING, 'invest_amount' => $invest->amount]);
    }

    public function pivotUserInvestList($condition)
    {
        $condition->join('invests', 'invests.id', 'invest_user.invest_id');
        $condition->join('users', 'users.id', 'invest_user.user_id');
        $condition->select('users.name', 'users.uid',  'invests.money_return', 'invests.accrual_days', 'invests.name as package_name', 'invest_user.*');
        return $condition->get();
    }

    public function pivotUserInvestUpdate($id, $data)
    {
        return DB::table('invest_user')->whereId($id)->update($data);
    }
}
