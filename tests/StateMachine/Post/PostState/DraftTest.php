<?php
declare (strict_types=1);

namespace App\Tests\StateMachine\Post\PostState;

use App\StateMachine\Post\InvalidPostTransformation;
use App\StateMachine\Post\PostState\Draft;
use PHPUnit\Framework\TestCase;

class DraftTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function shouldAllowSendToReview(): void
    {
        $draft = new Draft();
        $draft->sendToReview();
    }

    /** @test */
    public function shouldNotAllowPublish(): void
    {
        $draft = new Draft();

        $this->expectException(InvalidPostTransformation::class);
        $draft->publish();
    }

    /** @test */
    public function shouldNotAllowDeprecate(): void
    {
        $draft = new Draft();

        $this->expectException(InvalidPostTransformation::class);
        $draft->deprecate();
    }
}
