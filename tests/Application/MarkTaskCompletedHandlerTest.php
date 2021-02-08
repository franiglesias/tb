<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\MarkTaskCompletedHandler;
use App\Domain\Task;
use App\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class MarkTaskCompletedHandlerTest extends TestCase
{
    private const TASK_ID = 1;

    /** @test */
    public function shouldMarkTaskAsComplete(): void
    {
        $task = $this->createMock(Task::class);
        $task
            ->expects(self::once())
            ->method('markCompleted');

        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository
            ->method('retrieve')
            ->with(self::TASK_ID)
            ->willReturn($task);
        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with($task);

        $markTaskAsCompleted = new MarkTaskCompletedHandler($taskRepository);

        $markTaskAsCompleted->execute(self::TASK_ID, true);
    }
}
