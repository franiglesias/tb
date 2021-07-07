<?php

declare(strict_types=1);

namespace App\Domain;


class Task
{

    private int $id;
    private string $description;

    public function __construct(int $identity, string $description)
    {
        if (strlen($description) < 1) {
            throw new \InvalidArgumentException('Invalid description');
        }

        $this->id = $identity;

        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }
}
