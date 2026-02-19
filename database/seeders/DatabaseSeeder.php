<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Comment;
use App\Models\Task;
use App\Constant\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'email' => fake()->unique()->safeEmail(),
            'role' => Role::ROLE_ADMIN
        ]);

       $managers = User::factory(3)->create(['role' => 'manager']);
       $users = User::factory(10)->create(['role' => 'user']);

        Project::factory(5)->create([
            'created_by' => $admin->id
        ])->each(function ($project) use ($users) {

            $tasks = Task::factory(5)->create([
                'project_id' => $project->id,
                'assigned_to' => $users->random()->id,
            ]);

            $tasks->each(function ($task) use ($users) {
                Comment::factory(3)->create([
                    'task_id' => $task->id,
                    'user_id' => $users->random()->id,
                ]);
        });
    });
    }
}
