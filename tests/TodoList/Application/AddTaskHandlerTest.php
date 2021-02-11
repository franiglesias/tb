<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Application;

use App\TodoList\Application\AddTaskHandler;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class AddTaskHandlerTest extends TestCase
{
    /** @test */
    public function shouldCreateAndStoreATask(): void
    {
        $task = new Task(1, 'Task Description');

        $taskRepository = $this->createMock(TaskRepository::class);

        $taskRepository
            ->method('nextIdentity')
            ->willReturn(1);

        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with($task);

        $addTaskHandler = new AddTaskHandler($taskRepository);

        $addTaskHandler->execute('Task Description');
    }
}
