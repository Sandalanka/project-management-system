<?php

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use App\Classess\ApiCatchErrors;
use Exception;

class CommentService
{
   protected CommentRepository $commentRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    
    /**
     * 
     * Summary: Fetch comment
     */
    public function index(int $taskId)
    {
        try {
           return $this->commentRepository->index($taskId);

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while fetching comment-(service):'
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
           return $this->commentRepository->store($data, $taskId); 

        } catch (Exception $exception) {
            ApiCatchErrors::throw($exception,
                'An error occurred while creating comment-(service):'
            );

            throw $exception;
        }
    }
}
