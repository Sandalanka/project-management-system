<?php

namespace App\Contrasts\Task;

interface TaskContrast
{
    public function index(int $projectId);
    
    public function getById(int $taskId);

    public function store(array $data, int $projectId);

    public function update(array $data, int $taskId);

    public function destroy(int $taskId);
}
