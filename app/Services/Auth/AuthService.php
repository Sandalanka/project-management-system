<?php

namespace App\Services\Auth;

use App\Classess\ApiCatchErrors;
use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     *
     * Summary: User register
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function register(array $data): array
    {
        try {
            $user = $this->authRepository->register($data);

            Auth::login($user);

            $token = $user->createToken(config('system.api-token'))->plainTextToken;

            return [
                'token' => $token,
                'user' => $user
            ];

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating user-(service):'
            );

            throw $exception;
        }
    }

    /**
     *
     * Summary: User login
     *
     * @param array $data
     * @return array|string[]
     * @throws Exception
     */
    public function login(array $data): array
    {
        try {
            $user = $this->authRepository->getUser($data);

            if (!$user || !Hash::check($data['password'], $user->password))
            {
                return [
                    'status' => false
                ];
            }

            $token = $user->createToken(config('system.api-token'))->plainTextToken;

            return [
                'status' => true,
                'token' => $token,
                'user' => $user->makeHidden(['password', 'remember_token'])
            ];

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while login user-(service):'
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
            $this->authRepository->logout($request);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while logout user-(service):'
            );

            throw $exception;
        }
    }

    /**
     *
     * Summary: Get me
     *
     * @param Request $request
     * @return User
     * @throws Exception
     */
    public function me(Request $request): User
    {
        try {
            return $request->user()->makeHidden(['password', 'remember_token']);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while get user-(service):'
            );

            throw $exception;
        }
    }
}
