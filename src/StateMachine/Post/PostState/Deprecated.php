<?php
declare (strict_types=1);

namespace App\StateMachine\Post\PostState;

class Deprecated extends PostState
{

    public function toString(): string
    {
        return self::DEPRECATED;
    }
}
