<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use App\Constant\Messages;
use App\Constant\Status;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseRequest extends FormRequest
{
     /**
     *
     * Summary: Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     * Summary: Request failedValidation repose.
     *
     * @param Validator $validator
     * @return JsonResponse
     */
    public function failedValidation(Validator $validator): JsonResponse
    {
        Log::error(Messages::VALIDATION_ERROR_MESSAGE, [
            'request_class' => static::class,
            'controller_action' => $this->route()->getActionName(),
            'request_data' => $this->all(),
            'validation_errors' => $validator->errors()->all(),
            'user_id' => auth()->id() ?? null,
            'timestamp' => now()->toDateTimeString()
        ]);

        $response = [
            'status' => Status::STATUS_FAILED,
            'message' => Messages::VALIDATION_ERROR_MESSAGE,
            'errors' => $validator->errors(),
            'timestamp' => now()->toDateTimeString()
        ];

        throw new HttpResponseException(response()->json($response, Status::STATUS_CODE_UNPROCESSABLE_ENTITY, [
                'Access-Control-Allow-Origin' => '*',
                'Content-Type' => 'application/json'
            ]
        ));
    }
}
