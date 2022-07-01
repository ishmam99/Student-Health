<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
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
            // 'referred_by' => [ 'string', Rule::exists('users', 'uid')],
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')],
            'password'    => ['required', 'string', 'confirmed'],
            'phone'       => ['required', 'numeric',Rule::unique('users', 'phone')],
            'country'     => ['required', 'string', 'max:255'],
            // 'binance_id'  => ['required', 'string', 'max:255']
        ];
    }
}
