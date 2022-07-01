<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\RegistrationTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    use RegistrationTrait;

    public function withdraws()
    {
        $records = Transaction::where('type', 'withdraw')->with('user')->orderBy('created_at', 'desc')->paginate(20);
        $page = 'Withdraw';
        return view('backend.transaction.index', compact('records', 'page'));
    }

    public function deposits()
    {
        $records = Transaction::where('type', 'deposit')->with('user')->orderBy('created_at', 'desc')->paginate(20);
        $page = 'Deposits';
        return view('backend.transaction.index', compact('records', 'page'));
    }

    public function globalIncomes()
    {
        $records = Transaction::query()->where('type', 'Global Income')->with('user')->orderBy('created_at', 'desc')->paginate(20);
        $page = 'Global Income';
        return view('backend.transaction.index', compact('records', 'page'));
    }

    public function referralIncomes()
    {
        $records = Transaction::where('type', 'referral commission')->with('user')->orderBy('created_at', 'desc')->paginate(20);
        $page = 'Referral Income';
        return view('backend.transaction.index', compact('records', 'page'));
    }

    public function generationIncomes()
    {
        $records = Transaction::where('type', 'Generation Income')->with('user')->orderBy('created_at', 'desc')->paginate(20);
        $page = 'Generation Income';
        return view('backend.transaction.index', compact('records', 'page'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function received($id): RedirectResponse
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = "completed";

        DB::beginTransaction();
        try {
            if ($transaction->update()) {
                $user = User::find($transaction->user_id);
                $user->status = 1;
                $user->update();

//        $this->distributeSponsorCommission($user, $transaction->amount);
//        $this->distributeGlobalIncome(100, $user);
                $this->distributeGenerationIncome($user);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something wrong, Try Again.');
        }
        return back()->with('success', 'Transaction Completed.');
    }
}
