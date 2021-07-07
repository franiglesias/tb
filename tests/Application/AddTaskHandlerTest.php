<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\AddTaskHandler;
use App\Domain\Task;
use PHPUnit\Framework\TestCase;

class AddTaskHandlerTest extends TestCase
{
    private const TASK_ID = 1;
    private const TASK_DESCRIPTION = 'Write a test that fails';

    /** @test */
    public function shouldCreateAndPersistATaskWithProvidedDescription(): void
    {
        $taskRepository = $this->createMock(\App\Domain\TaskRepository::class);

        $taskRepository
            ->method('nextId')
            ->willReturn(self::TASK_ID);

        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with(new Task(self::TASK_ID, self::TASK_DESCRIPTION));

        $addTaskHandler = new AddTaskHandler($taskRepository);

        $addTaskHandler->execute(self::TASK_DESCRIPTION);
    }

}
