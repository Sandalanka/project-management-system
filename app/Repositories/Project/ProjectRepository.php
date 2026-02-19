<?php

namespace App\Repositories\Project;

use App\Contrasts\Project\ProjectContrast;
use Illuminate\Support\Facades\Cache;
use App\Models\Project;
use App\Classess\ApiCatchErrors;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProjectRepository implements ProjectContrast
{
    /**
     * 
     * Summary: Fetch project
     */
    public function index()
    {
        try {
            return Cache::remember('project', now()->addMinutes(10), function () {
                return Project::with('user:id,name,email')
                    ->withCount('tasks')
                    ->latest()
                    ->get();
            });

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching project-(repository):'
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
            return Project::where('id', $projectId)->with('tasks')->firstOrFail();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while get project-(repository):'
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
            $project = new Project();
            $project->title = $data['title'] ?? null;
            $project->description = $data['description'] ?? null;
            $project->start_date = $data['start_date'] ?? null;
            $project->end_date = $data['end_date'] ?? null;
            $project->created_by = Auth::user()->id;
            $project->save();

            return $project;

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while saving project-(repository):'
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
            Project::where('id', $projectId)->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date']
            ]);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while updating project-(repository):'
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
            Project::where('id', $projectId)->delete();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while deleting project-(repository):'
            );

            throw $exception;
        }
    }
}
