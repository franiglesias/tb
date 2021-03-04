<?php

declare(strict_types=1);

namespace App\Domain;

class Task
{

    private int $id;
    private string $description;

    public function __construct(int $id, string $description)
    {
        $this->id = $id;
        if ('' === $description) {
            throw new \InvalidArgumentException('Task Invalid');
        }
        $this->description = $description;
    }

    public function id(): int
    {
        return $this->id;
    }
}
