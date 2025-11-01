<?php

namespace App\Repositories;

use App\DTOs\TaskDTO;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository
{
    public function create(TaskDTO $task): Task
    {
        return Task::create([
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
        ]);
    }

    public function getList(): Collection {
        return Task::all();
    }
}