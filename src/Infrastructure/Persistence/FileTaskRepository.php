<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;


use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Lib\FileStorageEngine;

class FileTaskRepository implements TaskRepository
{

    /** @var FileStorageEngine */
    private FileStorageEngine $storageEngine;

    public function __construct(FileStorageEngine $storageEngine)
    {
        $this->storageEngine = $storageEngine;
    }

    public function nextId(): int
    {
        $tasks = $this->storageEngine->loadObjects(Task::class);

        return count($tasks) + 1;
    }

    public function store(Task $task): void
    {
        $tasks = $this->storageEngine->loadObjects(Task::class);

        $tasks[$task->getId()] = $task;

        $this->storageEngine->persistObjects($tasks);
    }
}
