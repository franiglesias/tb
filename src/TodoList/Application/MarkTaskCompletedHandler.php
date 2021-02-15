<?php

declare(strict_types=1);

namespace App\TodoList\Application;


use App\TodoList\Domain\TaskRepository;

class MarkTaskCompletedHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(int $taskId, bool $completed): void
    {
        $task = $this->taskRepository->retrieve($taskId);

        if ($completed) {
            $task->markCompleted();
        }

        $this->taskRepository->store($task);
    }
}
