<?php
declare (strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;

use App\Application\AddTask;
use App\Application\AddTaskHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTaskController
{

    private AddTaskHandler $addTaskHandler;

    public function __construct(AddTaskHandler $addTaskHandler)
    {
        $this->addTaskHandler = $addTaskHandler;
    }

    public function __invoke(Request $request): Response
    {
        $payload = $this->payload($request);

        $addTask = new AddTask($payload['task']);

        ($this->addTaskHandler)($addTask);

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    private function payload(Request $request): array
    {
        return json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }

}
