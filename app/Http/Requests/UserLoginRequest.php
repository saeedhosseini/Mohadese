<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserLoginRequest extends GlobalFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
                'national_code' => ['required', 'string',
                    'min:10', 'max:10'],
                'mobile' => ['required', 'string']
            ];
    }

    public function messages()
    {
        return [
            'national_code.required' => 'لطفا کد ملی خود را وارد کنید.',
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
        ];
    }

}
