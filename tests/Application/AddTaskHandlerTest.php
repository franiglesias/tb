<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\AddTaskHandler;
use App\Domain\Task;
use App\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class AddTaskHandlerTest extends TestCase
{
    private const NEW_TASK_ID = 1;
    private const NEW_TASK_DESCRIPTION = 'Task Description';

    /** @test */
    public function shouldAddATaskToRepository(): void
    {
        $task = new Task(self::NEW_TASK_ID, self::NEW_TASK_DESCRIPTION);

        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository
            ->method('nextId')
            ->willReturn(self::NEW_TASK_ID);
        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with($task);

        $addTaskHandler = new AddTaskHandler($taskRepository);

        $addTaskHandler->execute(self::NEW_TASK_DESCRIPTION);
    }
}
