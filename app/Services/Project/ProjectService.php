<?php

namespace App\Services\Project;

use App\Repositories\Project\ProjectRepository;
use App\Classess\ApiCatchErrors;
use Exception;
use Illuminate\Support\Facades\Cache;

class ProjectService
{
    protected ProjectRepository $projectRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    
    /**
     * 
     * Summary: Fetch project
     */
    public function index()
    {
        try {
           return $this->projectRepository->index();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching project-(service):'
            );

            throw $exception;
        }
    }
    
    /**
     * 
     * Summary: Get project
     */
    public function getById(int $projectId)
    {
       try {
           return $this->projectRepository->getById($projectId);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while getting project-(service):'
            );

            throw $exception;
        }
    }

    /**
     * 
     * Summary: Store project
     */
    public function store(array $data)
    {
       try {
           Cache::forget('project');

           return $this->projectRepository->store($data); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating project-(service):'
            );

            throw $exception;
        }
    }

    /**
     * 
     * Summary: Update project
     */
    public function update(array $data, int $projectId)
    {
       try {
           Cache::forget('project');

           return $this->projectRepository->update($data, $projectId); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while updating project-(service):'
            );

            throw $exception;
        }
    }

    /**
     * 
     * Summary: Delete project
     */
    public function destroy(int $projectId)
    {
       try {
           Cache::forget('project');

           return $this->projectRepository->destroy($projectId); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while deleting project-(service):'
            );

            throw $exception;
        }
    }
}
