<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UserLoginRequest extends BaseRequest
{
    /**
     *
     * Summary: Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required', 'string']
        ];
    }
}
