<?php
declare (strict_types=1);

namespace App\Application;

use App\Domain\TaskRepository;

class GetTasksHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke(GetTasks $getTasks): array
    {
        $taskList = $this->taskRepository->findAll();

        $transformedTaskList = [];
        foreach ($taskList as $task) {
            $transformedTaskList[] = $getTasks->taskTransformer()->transform($task);
        }

        return $transformedTaskList;
    }

}
