<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\EntryPoint\Api;


use App\TodoList\Application\AddTaskHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController
{
    /** @var AddTaskHandler */
    private AddTaskHandler $addTaskHandler;

    public function __construct(AddTaskHandler $addTaskHandler)
    {
        $this->addTaskHandler = $addTaskHandler;
    }

    public function addTask(Request $request): Response
    {
        $payload = $this->obtainPayload($request);

        $this->addTaskHandler->execute($payload['task']);

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    private function obtainPayload(Request $request): array
    {
        return json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }
}
