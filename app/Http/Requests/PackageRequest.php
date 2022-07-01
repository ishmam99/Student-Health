<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'name' => ['string','required'],
            'cost' => ['integer','required'],
            'tasks' => ['integer','required'],
            'ads_period_1_price' => ['required'],
            'ads_period_2_price' => ['required'],
            'ads_period_3_price' => ['required'],
            'ads_period_4_price' => ['required'],
            'minimum_withdraw_amount' => ['integer','required'],
        ];
    }
}
