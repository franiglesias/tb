<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Infrastructure\EntryPoint\Api;

use App\TodoList\Application\AddTaskHandler;
use App\TodoList\Application\GetTaskListHandler;
use App\TodoList\Application\MarkTaskCompletedHandler;
use App\TodoList\Application\UpdateTaskHandler;
use App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer;
use App\TodoList\Infrastructure\EntryPoint\Api\TodoListController;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use OutOfBoundsException;
use Symfony\Component\HttpFoundation\Request;

class TodoListControllerTest extends TestCase
{
    private const TASK_DESCRIPTION = 'Task Description';
    private const COMPLETED_TASK_ID = 1;
    private const TASK_ID = 1;

    private AddTaskHandler $addTaskHandler;
    private TodoListController $todoListController;
    private GetTaskListHandler $getTaskListHandler;
    private TaskListTransformer $taskListTransformer;
    private MarkTaskCompletedHandler $markTaskCompletedHandler;
    private UpdateTaskHandler $updateTaskHandler;

    protected function setUp(): void
    {
        $this->addTaskHandler = $this->createMock(AddTaskHandler::class);
        $this->getTaskListHandler = $this->createMock(GetTaskListHandler::class);
        $this->taskListTransformer = $this->createMock(TaskListTransformer::class);
        $this->markTaskCompletedHandler = $this->createMock(MarkTaskCompletedHandler::class);
        $this->updateTaskHandler = $this->createMock(UpdateTaskHandler::class);

        $this->todoListController = new TodoListController(
            $this->addTaskHandler,
            $this->getTaskListHandler,
            $this->taskListTransformer,
            $this->markTaskCompletedHandler,
            $this->updateTaskHandler
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

    /** @test */
    public function shouldMarkTaskCompleted(): void
    {
        $this->markTaskCompletedHandler
            ->expects(self::once())
            ->method('execute')
            ->with(self::COMPLETED_TASK_ID, true);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['completed' => true], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->markTaskCompleted(self::COMPLETED_TASK_ID, $request);

        self::assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function shouldModifyATask(): void
    {
        $this->updateTaskHandler
            ->expects(self::once())
            ->method('execute')
            ->with(self::TASK_ID, self::TASK_DESCRIPTION);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => self::TASK_DESCRIPTION], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->modifyTask(self::TASK_ID,$request);

        self::assertEquals(204, $response->getStatusCode());
    }


    /** @test */
    public function shouldFailWithBadRequestIfInvalidPayload(): void
    {
        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['invalid payload'], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->addTask($request);

        self::assertEquals(400, $response->getStatusCode());

        $body = json_decode($response->getContent(), true);

        self::assertEquals('Invalid payload', $body['error']);
    }


    /** @test */
    public function shouldFailWithBadRequestIfInvalidTaskField(): void
    {
        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => 12345], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->addTask($request);

        self::assertEquals(400, $response->getStatusCode());

        $body = json_decode($response->getContent(), true);

        self::assertEquals('Invalid payload', $body['error']);
    }


    /** @test */
    public function shouldFailWithBadRequestIfTaskDescriptionIsEmpty(): void
    {
        $exceptionMessage = 'Task description should not be empty';
        $exception = new InvalidArgumentException($exceptionMessage);

        $this->addTaskHandler
            ->method('execute')
            ->willThrowException($exception)
            ->with('');


        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => ''], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->addTask($request);

        self::assertEquals(400, $response->getStatusCode());

        $body = json_decode($response->getContent(), true);

        self::assertEquals($exceptionMessage, $body['error']);
    }

    /** @test */
    public function shouldFailWithNotFoundIdCompletingNotExistentTask(): void
    {
        $exceptionMessage = 'Task 3 doesn\'t exist';
        $exception = new OutOfBoundsException($exceptionMessage);

        $this->markTaskCompletedHandler
            ->method('execute')
            ->willThrowException($exception);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['completed' => true], JSON_THROW_ON_ERROR)
        );

        $response = $this->todoListController->markTaskCompleted(self::COMPLETED_TASK_ID, $request);

        self::assertEquals(404, $response->getStatusCode());

        $body = json_decode($response->getContent(), true);

        self::assertEquals($exceptionMessage, $body['error']);
    }

}
