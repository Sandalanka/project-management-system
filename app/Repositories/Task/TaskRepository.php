<?php

namespace App\Repositories\Task;

use App\Contrasts\Task\TaskContrast;
use Illuminate\Support\Facades\Cache;
use App\Models\Task;
use App\Classess\ApiCatchErrors;
use Exception;
use App\Constant\Status;

class TaskRepository implements TaskContrast
{
    /**
     * 
     * Summary: Fetch task
     */
    public function index(int $projectId)
    {
        try {
            return Task::with('assignedUser:id,name,email')
                ->where('project_id', $projectId)
                ->latest()
                ->get();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching task-(repository):'
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
            return Task::with('project', 'assignedUser')->findOrFail($taskId);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while get task-(repository):'
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
            return Task::create([
                'project_id' => $projectId,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? Status::PENDING,
                'due_date' => $data['due_date'] ?? null,
                'assigned_to' => $data['assigned_to']
            ]);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while saving task-(repository):'
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
            Task::where('id', $taskId)->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'due_date' => $data['due_date'],
                'assigned_to' => $data['assigned_to']
            ]);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while updating task-(repository):'
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
            Task::where('id', $taskId)->delete();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while deleting task-(repository):'
            );

            throw $exception;
        }
    }
}
