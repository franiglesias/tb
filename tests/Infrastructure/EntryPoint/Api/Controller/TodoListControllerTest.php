<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api\Controller;

use App\Application\AddTaskHandler;
use App\Application\GetTasksListHandler;
use App\Application\MarkTaskCompletedHandler;
use App\Infrastructure\EntryPoint\Api\Controller\TodoListController;
use App\Infrastructure\EntryPoint\Api\Formatter\TaskListFormatter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListControllerTest extends TestCase
{
    private AddTaskHandler $addTaskHandler;
    private TodoListController $todoListController;
    private MarkTaskCompletedHandler $markTaskCompletedHandler;
    private GetTasksListHandler $getTasksListHandler;
    private TaskListFormatter $taskListFormatter;

    protected function setUp(): void
    {
        $this->addTaskHandler = $this->createMock(AddTaskHandler::class);
        $this->markTaskCompletedHandler = $this->createMock(MarkTaskCompletedHandler::class);
        $this->getTasksListHandler = $this->createMock(GetTasksListHandler::class);
        $this->taskListFormatter = $this->createMock(TaskListFormatter::class);

        $this->todoListController = new TodoListController(
            $this->addTaskHandler,
            $this->markTaskCompletedHandler,
            $this->getTasksListHandler,
            $this->taskListFormatter
        );
    }

    /** @test */
    public function shouldAddTask(): void
    {
        $this->addTaskHandler
            ->expects(self::once())
            ->method('execute')
            ->with('Task Description');

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => 'Task Description'], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->addTask($request);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    /** @test */
    public function shouldMarkATaskCompleted(): void
    {
        $this->markTaskCompletedHandler
            ->expects(self::once())
            ->method('execute')
            ->with(1);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['done' => true], JSON_THROW_ON_ERROR)
        );

        $taskId = 1;
        $response = $this->todoListController->markTaskCompleted($taskId, $request);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /** @test */
    public function shouldGetListOfTasks(): void
    {
        $expectedList = ['[√] Task 1', '[ ] Task 2'];

        $this->getTasksListHandler
            ->expects(self::once())
            ->method('execute')
            ->with($this->taskListFormatter)
            ->willReturn($expectedList);

        $request = new Request();

        $response = $this->todoListController->getTasksList($request);

        $list = json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals($expectedList, $list);
    }
}
