<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\Persistence;


use App\Lib\FileStorageEngine;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use OutOfBoundsException;

class FileTaskRepository implements TaskRepository
{
    private FileStorageEngine $fileStorageEngine;

    public function __construct(FileStorageEngine $fileStorageEngine)
    {
        $this->fileStorageEngine = $fileStorageEngine;
    }

    public function store(Task $task): void
    {
        $tasks = $this->findAll();

        $tasks[$task->id()] = $task;

        $this->persistAllInStorage($tasks);
    }

    public function nextIdentity(): int
    {
        $tasks = $this->findAll();

        return count($tasks) + 1;
    }

    public function findAll(): array
    {
        return $this->getAllFromStorage();
    }

    public function retrieve(int $taskId): Task
    {
        $tasks = $this->findAll();

        if (!isset($tasks[$taskId])) {
            throw new OutOfBoundsException(
                sprintf('Task %s doesn\'t exist', $taskId)
            );
        }

        return $tasks[$taskId];
    }

    private function getAllFromStorage(): array
    {
        return $this->fileStorageEngine->loadObjects(Task::class);
    }

    private function persistAllInStorage(array $tasks): void
    {
        $this->fileStorageEngine->persistObjects($tasks);
    }
}
