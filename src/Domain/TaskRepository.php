<?php

declare(strict_types=1);

namespace App\Domain;


interface TaskRepository
{
    public function nextId(): int;

    public function store(Task $task): void;

    public function retrieve(int $taskId): Task;

    public function findAll(): array;
}
