<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\EntryPoint\Api;

class TaskListTransformer
{
    public function transform(array $taskList): array
    {
        $transformed = [];

        foreach ($taskList as $task) {
            $transformed[] = $task->representedAs('[:check] :id. :description');
        }

        return $transformed;
    }
}
