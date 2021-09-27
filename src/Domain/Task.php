<?php
declare (strict_types=1);

namespace App\Domain;

class Task
{
    private int $id;
    private string $description;

    public function __construct(int $id, string $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    public function id(): int
    {
        return $this->id;
    }
}
