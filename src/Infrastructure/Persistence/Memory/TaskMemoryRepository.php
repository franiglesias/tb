<?php
declare (strict_types=1);

namespace App\Infrastructure\Persistence\Memory;

use App\Domain\Task;
use App\Domain\TaskRepository;

class TaskMemoryRepository implements TaskRepository
{

    public function nextId(): int
    {
        throw new \RuntimeException('Implement nextId() method.');
    }

    public function store(Task $task): void
    {
        throw new \RuntimeException('Implement store() method.');
    }
}
