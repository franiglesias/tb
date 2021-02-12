<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Application;

use App\TodoList\Application\AddTaskHandler;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class AddTaskHandlerTest extends TestCase
{
    private const TASK_ID = 1;
    private const TASK_DESCRIPTION = 'Task Description';

    /** @test */
    public function shouldCreateAndStoreATask(): void
    {
        $taskRepository = $this->createMock(TaskRepository::class);

        $taskRepository
            ->method('nextIdentity')
            ->willReturn(self::TASK_ID);

        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with(new Task(self::TASK_ID, self::TASK_DESCRIPTION));

        $addTaskHandler = new AddTaskHandler($taskRepository);

        $addTaskHandler->execute(self::TASK_DESCRIPTION);
    }
}
