<?php

declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    /** @test */
    public function shouldHaveTextualRepresentation(): void
    {
        $task = new Task(1, 'Task Description');

        $formatted = $task->asString();

        self::assertEquals('[ ] 1. Task Description', $formatted);
    }

    /** @test */
    public function shouldHaveTextualRepresentationWhenDone(): void
    {
        $task = new Task(1, 'Task Description');
        $task->markCompleted();

        $formatted = $task->asString();

        self::assertEquals('[√] 1. Task Description', $formatted);
    }
}
