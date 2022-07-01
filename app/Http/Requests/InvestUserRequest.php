<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvestUserRequest extends FormRequest
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
            'transaction_id' => ['required'],
            'prove_document' => ['required','mimes:jpeg,jpg,png'],
            'invest_id' => ['required', Rule::exists('invests','id')],
            'invest_amount' => ['required']
        ];
    }
}
