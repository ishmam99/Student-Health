<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInvestApproveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'binance_id' => $this->binance_id,
            'package_name' => $this->package_name,
            'prove_document' => setImage($this->prove_document),
            'accrual_days' => $this->accrual_days,
            'approve_at' => $this->approved_at,
            'days_count' => daysCount($this->approved_at),
            'transaction_id' => $this->transaction_id
        ];
    }
}
