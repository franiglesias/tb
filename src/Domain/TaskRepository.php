<?php
declare (strict_types=1);

namespace App\Domain;

interface TaskRepository
{
    public function nextId(): int;

    public function store(Task $task): void;

    public function findAll(): array;
}
