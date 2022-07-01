<?php

namespace App\Http\Resources;

use App\Models\Withdraw;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function toArray($request)
    {
        return [
            'amount'       => $this->amount,
            'method'       => $this->method,
            // 'transaction_id' => $this->transaction_id,
            'binance_id'    =>$this->binance_id,
            'status'       => ($this->status == Withdraw::WITHDRAWPENDING ? 'pending' : ($this->status == Withdraw::WITHDRAWAPPROVE ? 'accepted' : 'canceled')),
            'created_date' => $this->created_at->format('F d, Y'),
        ];
    }
}
