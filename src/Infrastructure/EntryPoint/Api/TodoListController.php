<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;


use App\Application\AddTaskHandler;
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
        $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->addTaskHandler->execute($payload['task']);

        return new JsonResponse('', Response::HTTP_CREATED);
    }

}
