<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classess\ApiCatchErrors;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Constant\Status;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     *
     * Summary: User registration
     *
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        try{
            $request = $this->authService->register($request->validated());

            return $this->successResponse(
                data: $request,
                message: 'User registered successfully',
                statusCode: Status::STATUS_CODE_CREATED

            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating user-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     *
     * Summary: User login
     *
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        try{
            $login = $this->authService->login($request->validated());

            if($login['status'] == true){
                return $this->successResponse(
                    data: $login,
                    message: 'User login successfully'
                );
            }

            return $this->errorResponse(
                message: 'User invalid credentials',
                statusCode: Status::STATUS_CODE_UNAUTHORIZED

            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while login user-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     *
     * Summary: User logout
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try{
           $this->authService->logout($request);

            return $this->successResponse(
                message: 'User logout successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while logout user-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     *
     * Summary: Get profile
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        try{
            $user = $this->authService->me($request);

            return $this->successResponse(
                data: $user,
                message: 'Profile get successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching user-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
}
