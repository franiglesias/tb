<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Infrastructure\EntryPoint\Api;

use App\TodoList\Infrastructure\EntryPoint\Api\TodoListController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TodoListControllerTest extends TestCase
{

    /** @test */
    public function shouldAddTask(): void
    {
        $addTaskHandler = $this->createMock(\App\TodoList\Application\AddTaskHandler::class);
        $addTaskHandler
            ->expects(self::once())
            ->method('execute')
            ->with('Task Description');

        $todoListController = new TodoListController($addTaskHandler);

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => 'Task Description'], JSON_THROW_ON_ERROR)
        );

        $response = $todoListController->addTask($request);

        self::assertEquals(201, $response->getStatusCode());
    }
}
