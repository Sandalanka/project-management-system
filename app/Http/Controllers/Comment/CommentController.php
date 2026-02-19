<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Comment\CommentService;
use App\Classess\ApiCatchErrors;
use Exception;
use App\Http\Requests\Comment\CommentStoreRequest;
use Illuminate\Http\JsonResponse;
use App\Constant\Status;

class CommentController extends Controller
{
    protected CommentService $commentService;

    /**
     * Create a new class instance.
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * 
     * Summary: Fetch comment
     */
    public function index(int $taskId): JsonResponse
    {
        try{
            $comments = $this->commentService->index($taskId);

            return $this->successResponse(
                data: $comments,
                message: 'Comment fetched successfully'

            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching comment-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
    
    /**
     * 
     * Summary: Store comment
     */
    public function store(CommentStoreRequest $request, int $taskId): JsonResponse
    {
         try{
            $comment = $this->commentService->store($request->all(), $taskId);

            return $this->successResponse(
                data: $comment,
                message: 'Comment created successfully',
                statusCode: Status::STATUS_CODE_CREATED
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating comment-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
}
