<?php
declare (strict_types=1);

namespace App\StateMachine\Post\PostState;

use App\StateMachine\Post\InvalidPostTransformation;

abstract class PostState
{
    protected const DRAFT = 'draft';
    protected const PUBLISHED = 'published';
    protected const DEPRECATED = 'deprecated';
    protected const WAITING_REVIEW = 'waitingReview';

    public function fromString(string $postState): PostState
    {
        switch ($postState) {
            case self::DRAFT:
                return new Draft();
            case self::WAITING_REVIEW:
                return new WaitingReview();
            case self::PUBLISHED:
                return new Published();
            case self::DEPRECATED:
                return new Deprecated();
            default:
                throw new \InvalidArgumentException(sprintf('Invalid post state: %s', $postState));
        }
    }

    public static function create(): PostState
    {
        return new Draft();
    }

    public function sendToReview(): PostState
    {
        throw new InvalidPostTransformation();
    }

    public function publish(): PostState
    {
        throw new InvalidPostTransformation();
    }

    public function deprecate(): Deprecated
    {
        throw new InvalidPostTransformation();
    }

    abstract public function toString(): string;
}
