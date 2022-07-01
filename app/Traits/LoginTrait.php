<?php


namespace App\Traits;

use App\Models\DPS;
use App\Models\Nominee;
use App\Models\Transaction;
use App\Models\User;

trait LoginTrait
{
  public function dashboard($type, $id)
  {
    $user = User::query()->findOrFail($id);
    if ($user->id != $id) {
      return response()->json([
        'status' => 'failed',
        'msg'    => 'Unauthorized access. Try again.',
      ], 401);
    }
    $success['id'] = $user->id;
    $success['name'] = $user->name;
    $success['joining_date'] = isset($user->created_at) ? $user->created_at->toDateTimeString() : null;
    $success['sponsor_username'] = User::find($user->referred_by)->uid ?? 'No Sponsor';
    $success['total_sponsor'] = User::where('referred_by', $user->id)->count();
    $success['father'] = $user->father;
    $success['mother'] = $user->mother;
    $success['bkash'] = $user->bkash;
    $success['rocket'] = $user->rocket;
    $success['nogod'] = $user->nogod;
    $success['bank_ac'] = $user->bank_ac;
    $success['bank_name'] = $user->bank_name;
    $success['branch_name'] = $user->branch_name;
    $success['post_code'] = $user->post_code;
    $success['ps'] = $user->ps;
    $success['division'] = $user->division;
    $success['district'] = $user->district;
    $success['dob'] = $user->dob;
    $success['uid'] = $user->uid;
    $success['earned_balance'] = $user->point;
    $success['usertype'] = $user->type;
    $success['image'] = asset('storage/app/' . $user->image);

    $referral_income = Transaction::query()
      ->where('user_id', $user->id)
      ->where('type', 'referral commission')
      ->limit(50)
      ->get();
    $total_referral_income = Transaction::query()
      ->where('user_id', $user->id)
      ->where('type', 'referral commission')
      ->sum('amount');
    $global_income = Transaction::query()
      ->where('user_id', $user->id)
      ->where('type', 'Global Income')
      ->orderBy('id', 'desc')
      ->limit(50)
      ->get();
    $total_global_income = Transaction::query()
      ->where('user_id', $user->id)
      ->where('type', 'Global Income')
      ->orderBy('id', 'desc')
      ->sum('amount');
    $generation_income = Transaction::query()
      ->where('user_id', $user->id)
      ->where('type', 'Generation Income')
      ->limit(50)
      ->get();
    $total_generation_income = Transaction::query()
      ->where('user_id', $user->id)
      ->where('type', 'Generation Income')
      ->sum('amount');

    $success['referral_income'] = $referral_income;
    $success['total_referral_income'] = $total_referral_income;
    $success['global_income'] = $global_income;
    $success['total_global_income'] = $total_global_income;
    $success['generation_income'] = $generation_income;
    $success['total_generation_income'] = $total_generation_income;

    if ($type == "dps") {
      $dps_info = DPS::query()->where('user_id', $user->id)->first();
      if ($dps_info) {
        $success['dps_amount'] = $dps_info->amount;
        $success['installment'] = $dps_info->installment;
        $success['company'] = $dps_info->company;
        $success['last_paid_at'] = date("d-m-Y H:i", strtotime($dps_info->company));

        $nominee_info = Nominee::query()->where('d_p_s_id', $dps_info->id)->first();
        $success['nominee_name'] = $nominee_info->name;
        $success['nominee_mobile'] = $nominee_info->mobile;
        $success['nominee_relation'] = $nominee_info->relation;
        $success['nominee_image'] = asset('storage/app/' . $nominee_info->image);
        $success['nominee_nid_front'] = asset('storage/app/' . $nominee_info->nid);
        $success['nominee_nid_back'] = asset('storage/app/' . $nominee_info->nid_back);
      }
    }
    return $success;
  }
}
