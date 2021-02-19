<?php

declare(strict_types=1);

namespace App\TodoList\Domain;

use InvalidArgumentException;

class Task
{
    private int $id;
    private string $description;
    private bool $completed;

    public function __construct(int $id, string $description)
    {
        $this->id = $id;

        if ($description === '') {
            $exceptionMessage = 'Task description should not be empty';
            throw new InvalidArgumentException($exceptionMessage);
        }

        $this->description = $description;
        $this->completed = false;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function representedAs(string $format): string
    {
        $values = [
            ':check' => $this->completed ? '√' : ' ',
            ':id' => $this->id,
            ':description' => $this->description
        ];
        return strtr($format, $values);

    }

    public function markCompleted(): void
    {
        $this->completed = true;
    }
}
