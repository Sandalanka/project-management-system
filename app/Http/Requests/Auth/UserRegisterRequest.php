<?php

namespace App\Http\Requests\Auth;

use App\Constant\Role;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends BaseRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'role' => ['required', Rule::in(Role::ROLE_ADMIN, Role::ROLE_MANAGER, Role::ROLE_USER)],
            'phone' => ['required']

        ];
    }

    /**
     *
     * Summary: Error custom message
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please provide your name.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number,
                                 and one special character.',
            'role.required' => 'Role is required.',
            'role.in' => 'Role must be either admin, manager, or user.'
        ];
    }
}
