<?php

declare(strict_types=1);

namespace App\TodoList\Application;

use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;

class AddTaskHandler
{
    /** @var TaskRepository */
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(string $taskDescription): void
    {
       $id = $this->taskRepository->nextIdentity();

       $task = new Task($id, $taskDescription);

       $this->taskRepository->store($task);
    }
}
