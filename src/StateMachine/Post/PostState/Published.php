<?php
declare (strict_types=1);

namespace App\StateMachine\Post\PostState;

class Published extends PostState
{

    public function deprecate(): Deprecated
    {
        return new Deprecated();
    }

    public function toString(): string
    {
        return self::PUBLISHED;
    }
}
