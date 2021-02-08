<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\GetTasksListHandler;
use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Infrastructure\EntryPoint\Api\Formatter\TaskListFormatter;
use PHPUnit\Framework\TestCase;

class GetTasksListHandlerTest extends TestCase
{

    /** @test */
    public function shouldGetTheListOfTasks(): void
    {
        $tasks = [
            new Task(1, 'Task 1'),
            new Task(2, 'Task 2')
        ];

        $expectedList = ['[√] Task 1', '[ ] Task 2'];

        $tasksRepository = $this->createMock(TaskRepository::class);
        $tasksRepository->method('findAll')->willReturn($tasks);

        $formatter = $this->createMock(TaskListFormatter::class);
        $formatter
            ->expects(self::once())
            ->method('format')
            ->with($tasks)
            ->willReturn($expectedList);

        $getTaskListHandler = new GetTasksListHandler($tasksRepository);
        $list = $getTaskListHandler->execute($formatter);

        self::assertEquals($expectedList, $list);
    }
}
