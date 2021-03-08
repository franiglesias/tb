<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;


use App\Domain\Task;
use App\Domain\TaskRepository;

class FileTaskRepository implements TaskRepository
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
