<?php
declare (strict_types=1);

namespace App\StateMachine\Post;

class AsidesCollection implements \Countable
{
    private array $asides;

    public function __construct()
    {
        $this->asides = [];
    }

    public function count(): int
    {
        return count($this->asides);
    }

    public function prepend(string $aside): void
    {
        array_unshift($this->asides, $aside);
    }
}
