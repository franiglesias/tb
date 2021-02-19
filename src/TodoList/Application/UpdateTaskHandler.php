<?php
declare (strict_types=1);

namespace App\TodoList\Application;

use App\TodoList\Domain\TaskRepository;

class UpdateTaskHandler
{

    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(int $taskId, string $newTaskDescription): void
    {
        $task = $this->taskRepository->retrieve($taskId);

        $task->updateDescription($newTaskDescription);

        $this->taskRepository->store($task);
    }
}
