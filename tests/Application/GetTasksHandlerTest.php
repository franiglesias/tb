<?php
declare (strict_types=1);

namespace App\Tests\Application;

use App\Application\GetTasks;
use App\Application\GetTasksHandler;
use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Domain\TaskTransformer;
use PHPUnit\Framework\TestCase;

class GetTasksHandlerTest extends TestCase
{
    /** @test */
    public function shouldGetAllExistingTasks(): void
    {
        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository
            ->method('findAll')
            ->willReturn(
                [
                    new Task(1, 'Write a test that fails'),
                    new Task(2, 'Write production code')
                ]
            );

        $getTasksHandler = new GetTasksHandler($taskRepository);

        $taskTransformer = $this->createMock(TaskTransformer::class);
        $taskTransformer
            ->method('transform')
            ->willReturn(
                '[ ] 1. Write a test that fails',
                '[ ] 2. Write production code'
            );

        $getTaskCommand = new GetTasks($taskTransformer);

        $taskList = ($getTasksHandler)($getTaskCommand);

        $expected = [
            '[ ] 1. Write a test that fails',
            '[ ] 2. Write production code',
        ];
        self::assertEquals($expected, $taskList);
    }

}
