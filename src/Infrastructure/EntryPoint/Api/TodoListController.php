<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;


use App\Application\AddTaskHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController
{
    private AddTaskHandler $addTaskHandler;

    public function __construct(AddTaskHandler $addTaskHandler)
    {
        $this->addTaskHandler = $addTaskHandler;
    }

    public function addTask(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);

        $this->addTaskHandler->execute($payload['task']);

        return new JsonResponse('', 201);
    }
}
