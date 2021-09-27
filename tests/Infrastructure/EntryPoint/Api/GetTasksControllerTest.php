<?php
declare (strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Application\GetTasks;
use App\Application\GetTasksHandler;
use App\Domain\TaskTransformer;
use App\Infrastructure\EntryPoint\Api\GetTasksController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetTasksControllerTest extends TestCase
{

    /** @test */
    public function shouldGetAllTasks(): void
    {
        $taskTransformer = $this->createMock(TaskTransformer::class);
        $getTasksCommand = new GetTasks($taskTransformer);

        $getTaskUseCase = $this->createMock(GetTasksHandler::class);
        $getTaskUseCase
            ->expects($useCaseSpy = self::any())
            ->method('__invoke')
            ->with($getTasksCommand)
            ->willReturn([
                             '[ ] 1. Write a test that fails'
                         ]);
        $getTasksController = new GetTasksController($getTaskUseCase, $taskTransformer);

        $request = new Request();

        $response = ($getTasksController)($request);

        self::assertTrue($useCaseSpy->hasBeenInvoked());

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $payload = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $expected = [
            '[ ] 1. Write a test that fails'
        ];
        self::assertEquals($expected, $payload);
    }
}
