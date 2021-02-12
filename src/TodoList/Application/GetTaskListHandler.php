<?php

declare(strict_types=1);

namespace App\TodoList\Application;

use App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer;

class GetTaskListHandler
{
    public function execute(TaskListTransformer $taskListTransformer): array
    {
        throw new \RuntimeException(sprintf('Implement %s', __METHOD__));
    }
}
