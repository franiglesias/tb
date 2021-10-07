<?php
declare (strict_types=1);

namespace App\StateMachine\Post;

use App\StateMachine\Post\PostState\PostState;

class Post
{
    private string $title;
    private string $body;
    private PostState $postState;
    private AsidesCollection $asides;

    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body = $body;
        $this->postState = PostState::create();
        $this->asides = new AsidesCollection();
    }

    public static function create(string $title, string $body): self
    {
        return new self($title, $body);
    }

    public function status(): string
    {
        return $this->postState->toString();
    }

    public function sendToReview(): void
    {
        $this->postState = $this->postState->sendToReview();
    }

    public function publish(): void
    {
        $this->postState = $this->postState->publish();
    }

    public function deprecate(): void
    {
        $this->postState = $this->postState->deprecate();
        $this->asides->prepend('Deprecated content. Use at your own risk');
    }

    public function asides(): AsidesCollection
    {
        return $this->asides;
    }
}
