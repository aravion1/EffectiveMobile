<?php

namespace App\Factories;

use App\DTOs\TaskDTO;
use App\Http\Requests\CreateOrUpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskDTOFactories
{
    public static function createFromRequest(CreateOrUpdateTaskRequest $request): TaskDTO
    {
        return new TaskDTO(
            title: $request->input('title'),
            status: $request->input('status'),
            description: $request->input('description') ?? null
        );
    }

    public static function createFromModel(Task $task): TaskDTO
    {
        return new TaskDTO(
            title: $task->title,
            status: $task->status,
            description: $task->description,
            id: $task->id
        );
    }

    public static function createFromTaskCollection(Collection $taskCollection): Collection {
        return $taskCollection->map(function (Task $task) {
            return self::createFromModel($task);
        });
    }
}