<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api\Formatter;

use App\Domain\Task;
use App\Infrastructure\EntryPoint\Api\Formatter\TaskListFormatter;
use PHPUnit\Framework\TestCase;

class TaskListFormatterTest extends TestCase
{

    /** @test */
    public function shouldFormatAListOfTasks(): void
    {
        $expected = [
            '[√] 1. Task 1',
            '[ ] 2. Task 2'
        ];

        $task1 = $this->createMock(Task::class);
        $task1->method('asString')->willReturn('[√] 1. Task 1');

        $task2 = $this->createMock(Task::class);
        $task2->method('asString')->willReturn('[ ] 2. Task 2');

        $formatter = new TaskListFormatter();
        $formattedList = $formatter->format([$task1, $task2]);

        self::assertEquals($expected, $formattedList);
    }
}
