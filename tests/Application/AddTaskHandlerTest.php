<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\AddTaskHandler;
use App\Domain\Task;
use App\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class AddTaskHandlerTest extends TestCase
{
    /** @test */
    public function shouldAddTaskToARepository(): void
    {
        $taskRepository = $this->createMock(TaskRepository::class);

        $taskRepository
            ->method('nextId')
            ->willReturn(1);

        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with(new Task(1, 'Task Description'));

        $handler = new AddTaskHandler($taskRepository);

        $handler->execute('Task Description');
    }

}
