<?php
declare (strict_types=1);

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

    public function __invoke(AddTask $addTask): void
    {
        $id = $this->taskRepository->nextId();
        $description = $addTask->description();

        $task = new Task($id, $description);

        $this->taskRepository->store($task);
    }

}
