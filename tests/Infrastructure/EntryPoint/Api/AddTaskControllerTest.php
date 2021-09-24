<?php
declare (strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Application\AddTask;
use App\Application\AddTaskHandler;
use App\Infrastructure\EntryPoint\Api\AddTaskController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class AddTaskControllerTest extends TestCase
{
    /** @test */
    public function shouldAddANewTask(): void
    {
        $addTaskUseCase = $this->createMock(AddTaskHandler::class);
        $addTaskUseCase
            ->expects($useCaseSpy = self::any())
            ->method('__invoke')
            ->with(new AddTask('Write a test that fails'));

        $addTaskController = new AddTaskController($addTaskUseCase);

        $payload = ['task' => 'Write a test that fails'];

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );
        $response = ($addTaskController)($request);

        self::assertEquals(201, $response->getStatusCode());
        self::assertTrue($useCaseSpy->hasBeenInvoked());
    }

}
