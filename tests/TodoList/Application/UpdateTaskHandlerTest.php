<?php
declare (strict_types=1);

namespace App\Tests\TodoList\Application;

use App\TodoList\Application\UpdateTaskHandler;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class UpdateTaskHandlerTest extends TestCase
{

    private const TASK_ID = 1;

    public function testShouldUpdateATask(): void
    {
        $task = new Task(self::TASK_ID, 'Task Description');
        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository
            ->method('retrieve')
            ->with(self::TASK_ID)
            ->willReturn($task);
        $taskRepository
            ->expects(self::once())
            ->method('store')
            ->with(new Task(self::TASK_ID, 'New Task Description'));

        $updateTaskHandler = new UpdateTaskHandler($taskRepository);

        $updateTaskHandler->execute(self::TASK_ID, 'New Task Description');
    }
}
