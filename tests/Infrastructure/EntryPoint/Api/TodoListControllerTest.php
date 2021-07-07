<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Application\AddTaskHandler;
use App\Infrastructure\EntryPoint\Api\TodoListController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TodoListControllerTest extends TestCase
{
    private const TASK_DESCRIPTION = 'Task description';

    /** @test */
    public function shouldAddTask(): void
    {
        $addTaskHandler = $this->createMock(AddTaskHandler::class);
        $addTaskHandler
            ->expects(self::once())
            ->method('execute')
            ->with(self::TASK_DESCRIPTION);

        $controller = new TodoListController($addTaskHandler);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'application/json'],
            json_encode(['task' => self::TASK_DESCRIPTION])
        );

        $controller->addTask($request);
    }


    /** @test */
    public function shouldManageException(): void
    {
        $addTaskHandler = $this->createMock(AddTaskHandler::class);
        $exception = new \InvalidArgumentException('Invalid description');
        $addTaskHandler
            ->method('execute')
            ->willThrowException($exception);

        $controller = new TodoListController($addTaskHandler);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'application/json'],
            json_encode(['task' => ''])
        );

        $response = $controller->addTask($request);

        self::assertEquals(400, $response->getStatusCode());
    }

    /** @test */
    public function shouldManageBadPayload(): void
    {
        $addTaskHandler = $this->createMock(AddTaskHandler::class);

        $controller = new TodoListController($addTaskHandler);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'application/json'],
            json_encode([])
        );

        $response = $controller->addTask($request);

        self::assertEquals(400, $response->getStatusCode());
    }
}
