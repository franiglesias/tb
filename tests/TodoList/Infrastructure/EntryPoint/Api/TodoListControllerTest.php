<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Infrastructure\EntryPoint\Api;

use App\TodoList\Application\AddTaskHandler;
use App\TodoList\Application\GetTaskListHandler;
use App\TodoList\Infrastructure\EntryPoint\Api\TodoListController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TodoListControllerTest extends TestCase
{
    private const TASK_DESCRIPTION = 'Task Description';
    private AddTaskHandler $addTaskHandler;
    private TodoListController $todoListController;
    private GetTaskListHandler $getTaskListHandler;
    private \App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer $taskListTransformer;

    protected function setUp(): void
    {
        $this->addTaskHandler = $this->createMock(AddTaskHandler::class);
        $this->getTaskListHandler = $this->createMock(GetTaskListHandler::class);
        $this->taskListTransformer = $this->createMock(\App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer::class);
        $this->todoListController = new TodoListController(
            $this->addTaskHandler,
            $this->getTaskListHandler,
            $this->taskListTransformer
        );
    }


    /** @test */
    public function shouldAddTask(): void
    {
        $this->addTaskHandler
            ->expects(self::once())
            ->method('execute')
            ->with(self::TASK_DESCRIPTION);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => self::TASK_DESCRIPTION], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->addTask($request);

        self::assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function shouldGetTaskList(): void
    {
        $expectedList = [
            '[ ] 1. Task Description',
            '[ ] 2. Task Description',
        ];
        $this->getTaskListHandler
            ->expects(self::once())
            ->method('execute')
            ->with($this->taskListTransformer)
            ->willReturn($expectedList);

        $response = $this->todoListController->getTaskList(new Request());

        self::assertEquals(200, $response->getStatusCode());

        $list = json_decode($response->getContent(), true);

        self::assertEquals($expectedList, $list);
    }
}
