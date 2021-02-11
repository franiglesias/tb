<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\Persistence;


use App\Lib\FileStorageEngine;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;

class FileTaskRepository implements TaskRepository
{

    /** @var FileStorageEngine */
    private FileStorageEngine $fileStorageEngine;

    public function __construct(FileStorageEngine $fileStorageEngine)
    {
        $this->fileStorageEngine = $fileStorageEngine;
    }

    public function store(Task $task): void
    {
       $tasks = $this->fileStorageEngine->loadObjects(Task::class);

       $tasks[$task->id()] = $task;

       $this->fileStorageEngine->persistObjects($tasks);
    }

    public function nextIdentity(): int
    {
        $tasks = $this->fileStorageEngine->loadObjects(Task::class);

        return count($tasks) + 1;
    }
}
