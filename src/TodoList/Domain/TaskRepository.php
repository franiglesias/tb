<?php

declare(strict_types=1);

namespace App\TodoList\Domain;

interface TaskRepository
{
    public function store(Task $task): void;

    public function nextIdentity(): int;

    public function findAll(): array;

    public function retrieve(int $taskId): Task;
}
