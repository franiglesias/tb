<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Application;

use App\TodoList\Application\GetTaskListHandler;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer;
use PHPUnit\Framework\TestCase;

class GetTaskListHandlerTest extends TestCase
{
    /** @test */
    public function shouldGetExistingTasks(): void
    {
        $expectedList = [
            '[ ] 1. Write a test that fails',
            '[ ] 2. Write code to make the test pass',
        ];

        $taskList = [
            new Task(1, 'Write a test that fails'),
            new Task(2, 'Write code to make the test pass'),
        ];

        $tasksRepository = $this->createMock(TaskRepository::class);
        $tasksRepository
            ->method('findAll')
            ->willReturn($taskList);

        $taskListTransformer = $this->createMock(TaskListTransformer::class);
        $taskListTransformer
            ->expects(self::once())
            ->method('transform')
            ->with($taskList)
            ->willReturn($expectedList);

        $getTaskListHandler = new GetTaskListHandler($tasksRepository);
        $list = $getTaskListHandler->execute($taskListTransformer);

        self::assertEquals($expectedList, $list);
    }

}
