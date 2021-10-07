<?php
declare (strict_types=1);

namespace App\Tests\StateMachine\Post;

use App\StateMachine\Post\InvalidPostTransformation;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function shouldCreateANewPostWithDraftStatus(): void
    {
        $post = Post::create('Title', 'Body');

        self::assertEquals('draft', $post->status());
    }

    /** @test */
    public function shouldSendPostToReview(): void
    {
        $post = Post::create('Title', 'Body');
        $post->sendToReview();

        self::assertEquals('waitingReview', $post->status());
    }

    /** @test */
    public function shouldNotAllowPublishDraftPosts(): void
    {
        $post = Post::create('Title', 'Body');

        $this->expectException(InvalidPostTransformation::class);
        $post->publish();
    }

    /** @test */
    public function shouldAllowPublishPostWaitingForReview(): void
    {
        $post = Post::create('Title', 'Body');
        $post->sendToReview();
        $post->publish();

        self::assertEquals('published', $post->status());
    }

    /** @test */
    public function shouldAddAsideWhenDeprecatingPost(): void
    {
        $post = Post::create('Title', 'Body');
        $post->sendToReview();
        $post->publish();
        $post->deprecate();

        self::assertCount(1, $post->asides());
    }
}
