<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint\Api\Controller;


use App\Application\AddTaskHandler;
use App\Application\GetTasksListHandler;
use App\Application\MarkTaskCompletedHandler;
use App\Infrastructure\EntryPoint\Api\Formatter\TaskListFormatter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController
{

    private AddTaskHandler $addTask;
    private MarkTaskCompletedHandler $markTaskCompleted;
    private GetTasksListHandler $getTasksList;
    private TaskListFormatter $taskListFormatter;


    public function __construct(
        AddTaskHandler $addTask,
        MarkTaskCompletedHandler $markTaskCompleted,
        GetTasksListHandler $getTasksList,
        TaskListFormatter $taskListFormatter
    )
    {
        $this->addTask = $addTask;
        $this->markTaskCompleted = $markTaskCompleted;
        $this->getTasksList = $getTasksList;
        $this->taskListFormatter = $taskListFormatter;
    }

    public function addTask(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);

        $this->addTask->execute($payload['task']);

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    public function markTaskCompleted(int $taskid, Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);

        $done = $payload['done'];

        $this->markTaskCompleted->execute($taskid, $done);

        return new JsonResponse('', Response::HTTP_OK);
    }

    public function getTasksList(Request $request): Response
    {
        $list = $this->getTasksList->execute($this->taskListFormatter);

        return new JsonResponse($list, Response::HTTP_OK);
    }
}
