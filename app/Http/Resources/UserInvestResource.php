<?php

namespace App\Http\Resources;

use App\Models\Invest;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInvestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = '';
        $days_count = $this->pivot->approved_at == null ? 0 : daysCount($this->pivot->approved_at);
        if ($this->pivot->is_approved == Invest::APPROVE) {
            if ($this->accrual_days < $days_count) {
                if ($this->pivot->withdraw_status == Invest::WITHDRAWREQUEST) $status = 'Withdraw Request Pending';
                else if ($this->pivot->withdraw_status == Invest::WITHDRAWAPPROVED) $status = 'Withdraw Request Approved';
                else if ($this->pivot->withdraw_status == Invest::WITHDRAWCANCEL) $status = 'Withdraw Request Cancel';
                else $status = 'Accrual days completed';
            } else $status = 'Accrual days not completed yet';
        } else if ($this->pivot->is_approved == Invest::PENDING) $status = 'Invest Request Pending';
        else $status = 'Invest Request Cancel';
        return [
            'id' => $this->pivot->id,
            'name' => $this->name,
            'amount' => $this->pivot->invest_amount,
            'status' => $status,
            "accrual_days" => $this->accrual_days,
            'invest_count_days' => $days_count,
            'days_before_withdraw' => $this->accrual_days - $days_count,
            'created_at' => dateFormat($this->pivot->created_at),
        ];
    }
}
