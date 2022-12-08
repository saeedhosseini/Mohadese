<?php

namespace App\Http\Requests;

class InsuranceCreateRequest extends GlobalFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
                'title' => ['required', 'string',],
                'asset_icon' => ['required', 'string'],
            ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا نام را وارد کنید.',
            'asset_icon.required' => 'لطفا عکس را وارد کنید',
        ];
    }

}
