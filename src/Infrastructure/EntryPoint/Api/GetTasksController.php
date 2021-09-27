<?php
declare (strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;

use App\Application\GetTasks;
use App\Application\GetTasksHandler;
use App\Domain\TaskTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetTasksController
{
    private GetTasksHandler $getTasksHandler;
    private TaskTransformer $taskTransformer;

    public function __construct(GetTasksHandler $getTasksHandler, TaskTransformer $taskTransformer)
    {
        $this->getTasksHandler = $getTasksHandler;
        $this->taskTransformer = $taskTransformer;
    }

    public function __invoke(Request $request): Response
    {
        $getTasksCommand = new GetTasks($this->taskTransformer);
        $tasks = ($this->getTasksHandler)($getTasksCommand);

        return new JsonResponse($tasks, Response::HTTP_OK);
    }
}
