<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;


use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Lib\FileStorageEngine;

class FileTaskRepository implements TaskRepository
{
    private FileStorageEngine $storageEngine;

    public function __construct(FileStorageEngine $storageEngine)
    {
        $this->storageEngine = $storageEngine;
    }

    public function store(Task $task): void
    {
        $tasks = $this->storageEngine->loadObjects(Task::class);
        $tasks[$task->id()] = $task;
        $this->storageEngine->persistObjects($tasks);
    }

    public function nextId(): int
    {
        $tasks = $this->storageEngine->loadObjects(Task::class);

        return count($tasks) + 1;
    }

    public function retrieve(int $taskId): Task
    {
        $tasks = $this->storageEngine->loadObjects(Task::class);

        return $tasks[$taskId];
    }

    public function findAll(): array
    {
        return $this->storageEngine->loadObjects(Task::class);
    }
}
