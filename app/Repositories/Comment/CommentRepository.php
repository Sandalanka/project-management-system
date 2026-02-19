<?php

namespace App\Repositories\Comment;

use App\Contrasts\Comment\CommentContrast;
use App\Models\Comment;
use App\Classess\ApiCatchErrors;
use Exception;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentContrast
{
     /**
     * 
     * Summary: Fetch comment
     */
    public function index(int $taskId)
    {
        try {
            return Comment::with('user:id,name,email')
                ->where('task_id', $taskId)
                ->latest()
                ->get();

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching comment-(repository):'
            );

            throw $exception;
        }
    }
    
    /**
     * 
     * Summary: Store comment
     */
    public function store(array $data, int $taskId)
    {
        try {
            return Comment::create([
                'task_id' => $taskId,
                'user_id' => Auth::user()->id,
                'body' => $data['body']
            ]);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while saving comment-(repository):'
            );

            throw $exception;
        }
    }
}
