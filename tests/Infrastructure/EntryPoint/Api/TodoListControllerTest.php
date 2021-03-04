<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Application\AddTaskHandler;
use App\Application\GetTaskListHandler;
use App\Application\TaskConverter;
use App\Infrastructure\EntryPoint\Api\TodoListController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TodoListControllerTest extends TestCase
{
    private const TASK_DESCRIPTION = 'Write a test that fails';
    private TodoListController $controller;
    private GetTaskListHandler $getTasksListHandler;
    private AddTaskHandler $addTaskHandler;
    private TaskConverter $taskConverter;

    /** @test */
    public function shouldCreateATaskAndRespondWithCreated(): void
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
        $response = $this->controller->addTask($request);

        self::assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function shouldNotCreateATaskAndRespondWithCreated(): void
    {
        $exception = new \InvalidArgumentException('Task Invalid');
        $this->addTaskHandler
            ->method('execute')
            ->with('')
            ->willThrowException($exception);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => ''], JSON_THROW_ON_ERROR)
        );
        $response = $this->controller->addTask($request);

        self::assertEquals(400, $response->getStatusCode());
    }



    /** @test */
    public function shouldRetrieveAllTasks(): void
    {
        $taskList = [
            '[ ] 1. Write production code to make the test pass',
            '[ ] 2. Refactor things'
        ];

        $this->getTasksListHandler
            ->expects(self::once())
            ->method('execute')
            ->with($this->taskConverter)
            ->willReturn($taskList);

        $request = new Request();


        $response = $this->controller->getTasksList($request);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($taskList, json_decode($response->getContent()));
    }

    protected function setUp(): void
    {
        $this->taskConverter = $this->createMock(TaskConverter::class);

        $this->addTaskHandler = $this->createMock(AddTaskHandler::class);

        $this->getTasksListHandler = $this->createMock(GetTaskListHandler::class);

        $this->controller = new TodoListController(
            $this->addTaskHandler,
            $this->getTasksListHandler,
            $this->taskConverter
        );
    }


}
