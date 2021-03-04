<?php

declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    /** @test */
    public function shouldBeConstructedValid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Task(1, '');
    }
}
