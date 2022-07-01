<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'uid'         => 'required|unique:users,uid|min:4|max:255',
            'email'       => 'string|email|max:255',
            'password'    => 'required|string|min:6|max:255|confirmed',
            'sponsor'     => 'required|exists:users,uid',
            'mobile'      => 'required|numeric|digits:11',
            'type'        => ['required', 'string', Rule::in(['tbc', 'dps'])],
            'amount'      => 'required|numeric',
            'from'        => 'required|numeric|digits:11',
            'to'          => 'required|numeric|digits:11',
            'txn_id'      => 'required|string',
            'image'       => 'nullable|image',
            'nid'         => 'nullable|image',
            'nid_back'    => 'nullable|image',
            'other_image' => 'nullable|image',
        ];
    }
}
