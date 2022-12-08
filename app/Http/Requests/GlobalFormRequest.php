<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class GlobalFormRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, response: errorResponse(
            message: $this->showErrorValidation($validator),
            type: 'validation request', errorMessage: $this->showErrorValidation($validator, true))
        ));
    }

    function showErrorValidation(Validator $validator, bool $all = false): string
    {
        return $all ?
            implode(' , ', array_merge(...array_values($validator->errors()->messages())))
            : $validator->errors()->messages()[array_key_first($validator->errors()->messages())][0];
    }

}
