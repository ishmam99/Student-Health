<?php

namespace App\Http\Resources;

use App\Models\PackageUser;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->pivot->status == PackageUser::APPROVE) {
            $status = 'Request Approve';
        } else if ($this->pivot->status == PackageUser::CANCEL) {
            $status = 'Request Cancel';
        } else {
            $status = 'Request Pending';
        }
        // dd($this->updated_at);
        return [
            'package_name' => $this->name,
            'package_cost' => $this->cost,
            'status' => $status,
            'approve_at' => dateFormat($this->pivot->updated_at),
            'request_at' => dateFormat($this->pivot->created_at),
            'dayscount' => 200 - daysCount($this->pivot->updated_at)
        ];
    }
}
