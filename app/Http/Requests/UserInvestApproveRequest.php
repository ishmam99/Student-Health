<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInvestApproveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => $this->name,
            'binance_id' => $this->binance_id,
            'package_name' => $this->package_name,
            'prove_document' => setImage($this->image),
            'accrual_days' => $this->accrual_days,
            'days_count' => daysCount($this->approved_at),
            'transaction_id' => $this->transaction_id
        ];
    }
}
