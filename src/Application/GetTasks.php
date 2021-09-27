<?php
declare (strict_types=1);

namespace App\Application;

use App\Domain\TaskTransformer;

class GetTasks
{

    private TaskTransformer $taskTransformer;

    public function __construct(TaskTransformer $taskTransformer)
    {
        $this->taskTransformer = $taskTransformer;
    }

    public function taskTransformer(): TaskTransformer
    {
        return $this->taskTransformer;
    }
}
