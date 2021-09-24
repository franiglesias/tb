<?php
declare (strict_types=1);

namespace App\Application;

class AddTask
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }
}
