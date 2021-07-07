<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;


use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Lib\FileStorageEngine;

class FileTaskRepository implements TaskRepository
{

    /** @var FileStorageEngine */
    private FileStorageEngine $fileStorageEngine;

    public function __construct(FileStorageEngine $fileStorageEngine)
    {
        $this->fileStorageEngine = $fileStorageEngine;
    }

    public function nextId(): int
    {
        $tasks = $this->fileStorageEngine->loadObjects(Task::class);

        return count($tasks) + 1;
    }

    public function store(Task $task): void
    {
        $tasks = $this->fileStorageEngine->loadObjects(Task::class);

        $tasks[$task->id()] = $task;

        $this->fileStorageEngine->persistObjects($tasks);
    }
}
