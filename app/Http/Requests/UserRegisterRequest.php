<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserRegisterRequest extends GlobalFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'national_code' => ['required', 'string',
                'min:10', 'max:10', Rule::unique('users', 'national_code')],
            'mobile' => ['required', 'string', Rule::unique('users', 'mobile')]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا نام خود را وارد کنید.',
            'family.required' => 'لطفا نام خانوادگی خود را وارد کنید.',
            'national_code.required' => 'لطفا کد ملی خود را وارد کنید.',
            'national_code.unique' => ' کد ملی تکراری میباشد',
            'national_code.min' => 'فرمت کد ملی درست نمی باشد',
            'national_code.max' => 'فرمت کد ملی درست نمی باشد',
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'mobile.unique' => 'شماره تماس تکراری میباشد',
        ];
    }

}
