<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfitInvestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $profit_amount = 
        return [
            'id' => $this->pivot->id,
            'name' => $this->name,
            'amount' => $this->pivot->invest_amount,
            'created_at' => dateFormat($this->pivot->created_at),
        ];
    }
}
