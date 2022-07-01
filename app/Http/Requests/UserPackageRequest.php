<?php

namespace App\Http\Requests;

use App\Models\UserPackage;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserPackageRequest extends FormRequest
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
        // if (UserPackage::where('user_id', auth()->user()->id)->exists()) return $this->apiResponse(200, 'Already Send Request');
        return [
            'user_id'=> [Rule::exists('user_id', auth()->user()->id)], // not mendatory rule exits validation just for learn
            'transaction_id' => ['required'],
            'package_id' => ['required', Rule::exists('packages', 'id')], // not mendatory rule exits validation just for learn
            'prove_document'=> ['required']

        ];
    }
}
