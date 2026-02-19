<?php

namespace App\Repositories\Auth;

use App\Classess\ApiCatchErrors;
use App\Contrasts\Auth\AuthContrast;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthContrast
{
    /**
     *
     * Summary: Register user
     *
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function register(array $data): User
    {
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->role = $data['role'];
            $user->password = Hash::make($data['password']);
            $user->save();

            return $user->makeHidden(['password', 'remember_token']);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating user-(repository):'
            );

            throw $exception;
        }
    }

    /**
     *
     * Summary: Get user
     *
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function getUser(array $data): User
    {
        try {
           return User::where('email', $data['email'])->firstOrFail();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while getting user-(repository):'
            );

            throw $exception;
        }
    }

    /**
     *
     * Summary: User logout
     *
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function logout(Request $request): void
    {
        try {
            $request->user()->tokens()->delete();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while logout user-(repository):'
            );

            throw $exception;
        }
    }
}
