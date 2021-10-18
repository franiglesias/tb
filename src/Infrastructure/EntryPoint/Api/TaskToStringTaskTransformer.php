<?php
declare (strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;

use App\Domain\Task;
use App\Domain\TaskTransformer;

class TaskToStringTaskTransformer implements TaskTransformer
{

    public function transform(Task $task): string
    {
        return sprintf(
            '[ ] %s. %s',
            $task->id(),
            $task->description()
        );
    }
}
