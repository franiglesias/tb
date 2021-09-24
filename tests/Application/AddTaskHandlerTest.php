<?php
declare (strict_types=1);

namespace App\Tests\Application;

use App\Application\AddTask;
use App\Application\AddTaskHandler;
use App\Domain\Task;
use App\Domain\TaskRepository;
use PHPUnit\Framework\TestCase;

class AddTaskHandlerTest extends TestCase
{
    private const TASK_ID = 1;
    private const TASK_DESCRIPTION = 'Write a test that fails';

    /** @test */
    public function shouldCreateAndStoreANewTask(): void
    {
        $taskRepository = $this->createMock(TaskRepository::class);

        $taskRepository
            ->method('nextId')
            ->willReturn(self::TASK_ID);

        $taskRepository
            ->expects($repositorySpy = self::any())
            ->method('store')
            ->with(new Task(self::TASK_ID, self::TASK_DESCRIPTION));

        $addTaskHandler = new AddTaskHandler($taskRepository);

        $addTask = new AddTask(self::TASK_DESCRIPTION);

        ($addTaskHandler)($addTask);

        self::assertTrue($repositorySpy->hasBeenInvoked());
    }

}
