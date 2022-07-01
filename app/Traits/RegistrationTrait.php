<?php


namespace App\Traits;

use App\Models\Club;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait RegistrationTrait
{
    private int $maxLevelForGenerationIncome = 20;
    private array $generationIncomeRules = [
        1  => 50,
        2  => 30,
        3  => 25,
        4  => 20,
        5  => 15,
        6  => 10,
        7  => 10,
        8  => 10,
        9  => 10,
        10 => 10,
        11 => 10,
        12 => 10,
        13 => 10,
        14 => 10,
        15 => 10,
        16 => 10,
        17 => 10,
        18 => 10,
        19 => 10,
        20 => 10
    ];

    public function distributeReferralIncome($referralUser, $percentagePrice): bool
    {
        $referralUser->increment('balance', $percentagePrice);
        Transaction::newTransaction($referralUser->id, Transaction::TYPE_REFERRAL_BONUS, Transaction::STATUS_CREDITED, $percentagePrice);
        return true;
    }

    public function packageMigrationCharge(User $user): bool
    {
        $chargeAmount = $user->package->cost;
        if (Auth::user()->balance < $chargeAmount) {
            return false;
        }
        Auth::user()->decrement('balance', $chargeAmount);
        Transaction::newTransaction(Auth::id(), Transaction::TYPE_PACKAGE_MIGRATION_COST, Transaction::STATUS_DEBITED, $chargeAmount);
        return true;
    }

    public function distributeGenerationIncome($user)
    {
        $tempUser = $user;
        $transactionalData = [];
        $updatableBalance = [];
        $levelCounter = 1;
        while (($tempUser = $tempUser->referredBy) && ($levelCounter <= $this->maxLevelForGenerationIncome)) {
            $bonusAmount = $this->generationIncomeRules[$levelCounter];
            $updatableBalance[$bonusAmount][] = $tempUser->id;
            $transactionalData[] = [
                'user_id'        => $tempUser->id,
                'transaction_id' => Str::uuid(),
                'amount'         => $bonusAmount,
                'type'           => Transaction::TYPE_GENERATION_INCOME,
                'status'         => Transaction::STATUS_CREDITED
            ];
            $levelCounter++;
        }

        foreach ($updatableBalance as $amount => $userIds) {
            User::whereIn('id', $userIds)->increment('balance', $amount);
        }
        Transaction::insert($transactionalData);
    }
}
