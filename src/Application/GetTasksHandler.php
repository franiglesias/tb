<?php
declare (strict_types=1);

namespace App\Application;

class GetTasksHandler
{
    public function __invoke(GetTasks $getTasks): array
    {
        throw new \RuntimeException('Implement __invoke() method.');
    }

}
