<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestUserController extends Controller
{
    public function investRequestList() // user invest request list with if admin cancel the invest invitaion
    {
        $invests = $this->pivotUserInvestList(DB::table('invest_user')->whereIn('is_approved', [Invest::PENDING, Invest::CANCEL]));
        return view('backend.user-investment.requests', compact('invests'));
    }

    public function statusInvestment(Request $request, $id)
    {
        $this->pivotUserInvestUpdate($id, ['approved_at' => Carbon::today(), 'is_approved' => $request->is_approved]);
        if ($request->is_approved == Invest::APPROVE) {
            $invest = DB::table('invest_user')->find($id);
            $user = User::find($invest->user_id);
            $user->increment('balance', $invest->invest_amount);
            return back()->with('success', 'User Invest Request Approve Successfully');
        } else return back()->with('warning', 'User Invest Request Request Cancel Successfully');
    }

    public function userApproveList()  // if admin acccept User's Invest invitations and also accept withdraw request
    {
        $invests = $this->pivotUserInvestList(DB::table('invest_user')->where('is_approved', Invest::APPROVE));
        return view('backend.user-investment.index', compact('invests'));
    }

    public function withdrawList()
    {
        $query = DB::table('invest_user')->orWhere('is_approved', Invest::APPROVE);
        $query->whereIn('withdraw_status', [Invest::WITHDRAWREQUEST, Invest::WITHDRAWCANCEL]);
        $invests = $this->pivotUserInvestList($query);
        return view('backend.user-investment.withdraw', compact('invests'));
    }

    public function statusWithdraw(Request $request, $id)
    {
        $message = '';
        if ($request->withdraw_status == Invest::WITHDRAWAPPROVED) {
            $request->validate([
                'profit_amount'      => ['required', 'numeric'],
                'withdraw_status' => ['required', 'integer']
            ]);
            $input = $request->only('profit_amount', 'withdraw_status');
            $message = 'User Invest Withdraw Request Approve Successfully';
        } else {
            $input = $request->only('withdraw_status');
            $message = 'User Invest Request Withdraw Request Cancel Successfully';
        }
        $this->pivotUserInvestUpdate($id, $input);
        return redirect(route('user-invest.withdraw.list'))->with('success', $message);
    }

    public function show($id)
    {
        $invest = $this->pivotUserInvestList(DB::table('invest_user')->where('invest_user.id', $id))->first();
        return view('backend.user-investment.edit', compact('invest'));
    }

    public function pivotUserInvestList($condition)
    {
        $condition->join('invests', 'invests.id', 'invest_user.invest_id');
        $condition->join('users', 'users.id', 'invest_user.user_id');
        $condition->select('users.name', 'users.uid',  'invests.money_return', 'invests.accrual_days', 'invests.name as package_name', 'invest_user.*');
        return $condition->paginate(10);
    }

    public function pivotUserInvestUpdate($id, $data)
    {
        return DB::table('invest_user')->whereId($id)->update($data);
    }
}
