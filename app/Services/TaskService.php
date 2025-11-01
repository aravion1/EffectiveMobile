<?php

namespace App\Services;

use App\DTOs\TaskDTO;
use App\Repositories\TaskRepository;
use Illuminate\Support\Collection;
use App\Models\Task;
use App\Factories\TaskDTOFactories;

class TaskService
{
    public function __construct(protected TaskRepository $taskRepository)
    {

    }

    public function createTask(TaskDTO $taskDTO): TaskDTO
    {
        $task = $this->taskRepository->create($taskDTO);
        return TaskDTOFactories::createFromModel($task);
    }

    public function getListAsDTOs(): Collection  {
        return TaskDTOFactories::createFromTaskCollection($this->taskRepository->getList());
    }

    public function updateTask(Task $task, TaskDTO $taskDTO): TaskDTO {
        if (!$task->update([
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'status' => $taskDTO->status,
        ])) {
            throw new \Exception('Task update failed', 500);
        }

        return TaskDTOFactories::createFromModel($task->fresh());
    }

}