<?php

declare(strict_types=1);

namespace App\Domain;


class Task
{

    private int $id;
    private string $description;
    private bool $done;

    public function __construct(int $id, string $description)
    {
        $this->id = $id;
        $this->description = $description;
        $this->done = false;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function markCompleted(): void
    {
        $this->done = true;
    }

    public function asString(): string
    {
        $done = $this->done ? '√' : ' ';
        return sprintf('[%s] %s. %s', $done, $this->id, $this->description);
    }
}
