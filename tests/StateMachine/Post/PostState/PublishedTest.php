<?php
declare (strict_types=1);

namespace App\Tests\StateMachine\Post\PostState;

use App\StateMachine\Post\PostState\Published;
use PHPUnit\Framework\TestCase;

class PublishedTest extends TestCase
{

    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function shouldAllowDeprecate(): void
    {
        $published = new Published();

        $published->deprecate();
    }
}
