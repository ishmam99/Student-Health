<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request)
    {
       // dd($this);
        return [
            'id'               => $this->id,
            'name'             => $this->name,
             'uid'              => $this->uid,
            'phone'            => $this->phone,
             'email'            => $this->email,
             'country'          => $this->country,
             'main_balance'     => $this->balance,
             'shopping_balance' => $this->shopping_balance,
             'referral_balance' => $this->referral_balance,
             'count_referred_user' => $this->count_referred_user,
             'total_balance'    => $this->balance + $this->shopping_balance,
             'joining_date'     => $this->created_at->format('d F, Y'),
             'closing_date'     => $this->account_expire_on ? $this->account_expire_on->format('d F, Y') : null,
             'profile_picture'  => $this->hasMedia('profile_picture') ? $this->getFirstMediaUrl('profile_picture') : null,
             'package_title'    => $this->package_id ? $this->whenLoaded('package', $this->package->name, '')  : 'No Active Package',
             'validity'         =>200 - daysCount($this->package->updated_at)
        ];
    }
}
