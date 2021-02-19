<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Application\AddTaskHandler;
use App\Infrastructure\EntryPoint\Api\TodoListController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TodoListControllerTest extends TestCase
{
    private const TASK_DESCRIPTION = 'Write a test that fails';

    /** @test */
    public function shouldCreateATaskAndRespondWithCreated(): void
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
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => self::TASK_DESCRIPTION], JSON_THROW_ON_ERROR)
        );
        $response = $controller->addTask($request);

        self::assertEquals(201, $response->getStatusCode());
    }

}
