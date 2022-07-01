<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoRequest extends FormRequest
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
            'thumbnail' => ['nullable', 'mimes:jpg,jpeg,png,webp,gif', 'max:1024'],
            'title'     => ['required', 'string', 'max:255'],
            'link'      => ['required', 'string'],
            'status'    => ['required', Rule::in('on', 'off', '0', '1', 'true', 'false')],
        ];
    }
}
