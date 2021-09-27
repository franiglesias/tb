<?php
declare (strict_types=1);

namespace App\Infrastructure\Persistence\Memory;

use App\Domain\Task;
use App\Domain\TaskRepository;

class TaskMemoryRepository implements TaskRepository
{
    /** @var array<Task>  */
    private array $tasks = [];

    public function nextId(): int
    {
        return count($this->tasks) + 1;
    }

    public function store(Task $task): void
    {
        $this->tasks[$task->id()] = $task;
    }

    public function findAll(): array
    {
        return $this->tasks;
    }
}
