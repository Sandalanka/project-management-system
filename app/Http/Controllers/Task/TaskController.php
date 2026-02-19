<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Task\TaskService;
use App\Classess\ApiCatchErrors;
use Exception;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Constant\Status;

class TaskController extends Controller
{
    protected TaskService $taskService;

    /**
     * Create a new class instance.
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * 
     * Summary: Fetch task
     */
    public function index(int $projectId): JsonResponse
    {
        try{
            $tasks = $this->taskService->index($projectId);

            return $this->successResponse(
                data: $tasks,
                message: 'Task fetched successfully'

            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching task-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
    
    /**
     * 
     * Summary: Get task
     */
    public function getById(int $taskId): JsonResponse
    {
        try{
            $task = $this->taskService->getById($taskId);

            return $this->successResponse(
                data: $task,
                message: 'Task fetched successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while getting task-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     * 
     * Summary: Store task
     */
    public function store(TaskStoreRequest $request, int $projectId): JsonResponse
    {
         try{
            $task = $this->taskService->store($request->all(), $projectId);

            return $this->successResponse(
                data: $task,
                message: 'Task created successfully',
                statusCode: Status::STATUS_CODE_CREATED
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating task-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     * 
     * Summary: Update task
     */
    public function update(TaskUpdateRequest $request, int $taskId): JsonResponse
    {
        try{
            $this->taskService->update($request->all(), $taskId);

            return $this->successResponse(
                message: 'Task updated successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while updating task-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     * 
     * Summary: Delete task
     */
    public function destroy(int $taskId): JsonResponse
    {
        try{
            $this->taskId->destroy($taskId);

            return $this->successResponse(
                message: 'Task deleted successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while deleting task-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
}
