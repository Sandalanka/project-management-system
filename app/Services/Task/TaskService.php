<?php

namespace App\Services\Task;

use App\Repositories\Task\TaskRepository;
use App\Classess\ApiCatchErrors;
use Exception;

class TaskService
{
    protected TaskRepository $taskRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    
    /**
     * 
     * Summary: Fetch task
     */
    public function index(int $projectId)
    {
        try {
           return $this->taskRepository->index($projectId);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching task-(service):'
            );

            throw $exception;
        }
    }
    
    /**
     * 
     * Summary: Get task
     */
    public function getById(int $taskId)
    {
       try {
           return $this->taskRepository->getById($taskId);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while getting task-(service):'
            );

            throw $exception;
        }
    }

    /**
     * 
     * Summary: Store task
     */
    public function store(array $data, int $projectId)
    {
       try {
           return $this->taskRepository->store($data, $projectId); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating task-(service):'
            );

            throw $exception;
        }
    }

    /**
     * 
     * Summary: Update task
     */
    public function update(array $data, int $taskId)
    {
       try {
           return $this->taskRepository->update($data, $taskId); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while updating task-(service):'
            );

            throw $exception;
        }
    }

    /**
     * 
     * Summary: Delete task
     */
    public function destroy(int $taskId)
    {
       try {
           return $this->taskRepository->destroy($taskId); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while deleting task-(service):'
            );

            throw $exception;
        }
    }
}
