<?php

namespace App\Contrasts\Comment;

interface CommentContrast
{
    public function index(int $taskId);
    
    public function store(array $data, int $taskId);
}
