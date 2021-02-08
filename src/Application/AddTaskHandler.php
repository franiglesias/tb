<?php

declare(strict_types=1);

namespace App\Application;


use App\Domain\Task;
use App\Domain\TaskRepository;

class AddTaskHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(string $taskDescription): void
    {
        $id = $this->taskRepository->nextId();

        $task = new Task($id, $taskDescription);

        $this->taskRepository->store($task);
    }
}
