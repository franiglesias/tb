<?php

declare(strict_types=1);

namespace App\Application;


use App\Domain\TaskRepository;
use App\Infrastructure\EntryPoint\Api\Formatter\TaskListFormatter;

class GetTasksListHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(TaskListFormatter $taskListFormatter): array
    {
        $tasks = $this->taskRepository->findAll();

        return $taskListFormatter->format($tasks);
    }
}
