<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\EntryPoint\Api;

use App\TodoList\Application\AddTaskHandler;
use App\TodoList\Application\GetTaskListHandler;
use App\TodoList\Application\MarkTaskCompletedHandler;
use InvalidArgumentException;
use OutOfBoundsException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function is_string;

class TodoListController
{
    private AddTaskHandler $addTaskHandler;
    private GetTaskListHandler $getTaskListHandler;
    private TaskListTransformer $taskListTransformer;
    private MarkTaskCompletedHandler $markTaskCompletedHandler;

    public function __construct(
        AddTaskHandler $addTaskHandler,
        GetTaskListHandler $getTaskListHandler,
        TaskListTransformer $taskListTransformer,
        MarkTaskCompletedHandler $markTaskCompletedHandler
    ) {
        $this->addTaskHandler = $addTaskHandler;
        $this->getTaskListHandler = $getTaskListHandler;
        $this->taskListTransformer = $taskListTransformer;
        $this->markTaskCompletedHandler = $markTaskCompletedHandler;
    }

    public function addTask(Request $request): Response
    {
        $payload = $this->obtainPayload($request);

        if (! $this->isValidPayload($payload)) {
            return new JsonResponse(['error' => 'Invalid payload'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->addTaskHandler->execute($payload['task']);
        } catch (InvalidArgumentException $invalidTaskDescription) {
            return new JsonResponse(['error' => $invalidTaskDescription->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    public function getTaskList(Request $request): Response
    {
        $taskList = $this->getTaskListHandler->execute($this->taskListTransformer);

        return new JsonResponse($taskList, Response::HTTP_OK);
    }

    public function markTaskCompleted(int $taskId, Request $request): Response
    {
        $payload = $this->obtainPayload($request);

        try {
            $this->markTaskCompletedHandler->execute($taskId, $payload['completed']);
        } catch (OutOfBoundsException $taskNotFound) {
            return new JsonResponse(['error' => $taskNotFound->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse('', Response::HTTP_OK);
    }

    private function obtainPayload(Request $request): array
    {
        return json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }

    private function isValidPayload(array $payload): bool
    {
        return isset($payload['task']) && is_string($payload['task']);
    }
}
