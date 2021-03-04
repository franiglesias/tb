<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;


use App\Application\AddTaskHandler;
use App\Application\GetTaskListHandler;
use App\Application\TaskConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController
{
    /** @var AddTaskHandler */
    private AddTaskHandler $addTaskHandler;
    /** @var GetTaskListHandler */
    private GetTaskListHandler $getTaskListHandler;
    /** @var TaskConverter */
    private TaskConverter $taskConverter;

    public function __construct(
        AddTaskHandler $addTaskHandler,
        GetTaskListHandler $getTaskListHandler,
        TaskConverter $taskConverter
    )
    {
        $this->addTaskHandler = $addTaskHandler;
        $this->getTaskListHandler = $getTaskListHandler;
        $this->taskConverter = $taskConverter;
    }

    public function addTask(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        try {
            $this->addTaskHandler->execute($payload['task']);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    public function getTasksList(): Response
    {
        $list = $this->getTaskListHandler->execute($this->taskConverter);

        return new JsonResponse($list);
    }

}
