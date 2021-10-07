<?php
declare (strict_types=1);

namespace App\StateMachine\Post\PostState;

class WaitingReview extends PostState
{

    public function publish(): PostState
    {
        return new Published();
    }

    public function toString(): string
    {
        return self::WAITING_REVIEW;
    }
}
