<?php
declare (strict_types=1);

namespace App\StateMachine\Post\PostState;

final class Draft extends PostState
{

    public function sendToReview(): WaitingReview
    {
        return new WaitingReview();
    }

    public function toString(): string
    {
        return self::DRAFT;
    }
}
