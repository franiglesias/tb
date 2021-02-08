<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint\Api\Formatter;


class TaskListFormatter
{
    public function format(array $tasks): array
    {
        $formatted = [];

        foreach ($tasks as $task) {
            $formatted[] = $task->asString();
        }

        return $formatted;
    }
}
