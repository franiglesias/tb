<?php

declare(strict_types=1);

namespace App\TodoList\Application;

use App\TodoList\Domain\TaskRepository;
use App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer;

class GetTaskListHandler
{
    /** @var TaskRepository */
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(TaskListTransformer $taskListTransformer): array
    {
        $tasks = $this->taskRepository->findAll();

        return $taskListTransformer->transform($tasks);
    }
}
