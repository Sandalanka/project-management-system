<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Project\ProjectService;
use App\Classess\ApiCatchErrors;
use Exception;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Constant\Status;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    /**
     * Create a new class instance.
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * 
     * Summary: Fetch project
     */
    public function index(): JsonResponse
    {
        try{
            $projects = $this->projectService->index();

            return $this->successResponse(
                data: $projects,
                message: 'Projects fetched successfully'

            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching project-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
    
    /**
     * 
     * Summary: Get project
     */
    public function getById(int $projectId): JsonResponse
    {
        try{
            $project = $this->projectService->getById($projectId);

            return $this->successResponse(
                data: $project,
                message: 'Projects fetched successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while getting project-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     * 
     * Summary: Store project
     */
    public function store(ProjectStoreRequest $request): JsonResponse
    {
         try{
            $project = $this->projectService->store($request->all());

            return $this->successResponse(
                data: $project,
                message: 'Project created successfully',
                statusCode: Status::STATUS_CODE_CREATED
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while getting project-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     * 
     * Summary: Update project
     */
    public function update(ProjectUpdateRequest $request, int $projectId): JsonResponse
    {
        try{
            $this->projectService->update($request->all(), $projectId);

            return $this->successResponse(
                message: 'Project updated successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while updating project-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }

    /**
     * 
     * Summary: Delete project
     */
    public function destroy(int $projectId): JsonResponse
    {
        try{
            $this->projectService->destroy($projectId);

            return $this->successResponse(
                message: 'Project deleted successfully'
            );

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while deleting project-(controller):'
            );

            return $this->errorResponse(
                exception: $exception
            );
        }
    }
}
