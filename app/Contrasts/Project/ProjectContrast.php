<?php

namespace App\Contrasts\Project;

interface ProjectContrast
{
    public function index();
    
    public function getById(int $projectId);

    public function store(array $data);

    public function update(array $data, int $projectId);

    public function destroy(int $projectId);
}
