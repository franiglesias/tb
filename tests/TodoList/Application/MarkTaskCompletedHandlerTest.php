<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Application;

use App\TodoList\Application\MarkTaskCompletedHandler;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class MarkTaskCompletedHandlerTest extends TestCase
{
    private const COMPLETED_TASK_ID = 1;

    /** @test */
    public function shouldMarkTaskAsCompletedAndPersist(): void
    {
        $task = new Task(self::COMPLETED_TASK_ID, 'Task Description');

        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository
            ->method('retrieve')
            ->with(self::COMPLETED_TASK_ID)
            ->willReturn($task);

        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with($task);

        $markTaskCompletedHandler = new MarkTaskCompletedHandler($taskRepository);

        $markTaskCompletedHandler->execute(self::COMPLETED_TASK_ID, true);
    }
}
