<?php

declare(strict_types=1);

namespace App\Application;


use App\Domain\TaskRepository;

class MarkTaskCompletedHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(int $taskId, bool $done): void
    {
        $task = $this->taskRepository->retrieve($taskId);

        $task->markCompleted();

        $this->taskRepository->store($task);
    }
}
