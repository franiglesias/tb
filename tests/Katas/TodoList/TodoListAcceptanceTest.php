<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TodoListAcceptanceTest extends WebTestCase
{
    private Client $client;

    /** @test */
    public function asUserIWantToAddTaskToAToDoList(): void
    {
        $this->givenIRequestToCreateATaskWithDescription('Write a test that fails');
        $response = $this->whenIRequestTheListOfTasks();
        $this->thenICanSeeAddedTasksInTheList(
            [
                '[ ] 1. Write a test that fails',
            ],
            $response
        );
    }

    /** @test */
    public function asUserIWantToSeeTheTasksInMyTodoList(): void
    {
        $this->givenIHaveAddedTasks(
            [
                'Write a test that fails',
                'Write code to make the test pass',
            ]
        );
        $response = $this->whenIRequestTheListOfTasks();
        $this->thenICanSeeAddedTasksInTheList(
            [
                '[ ] 1. Write a test that fails',
                '[ ] 2. Write code to make the test pass',
            ],
            $response
        );
    }

    /** @test */
    public function asUserIWantToMarkTasksAsCompleted(): void
    {
        $this->givenIHaveAddedTasks(
            [
                'Write a test that fails',
                'Write code to make the test pass',
            ]
        );
        $this->givenIMarkATaskAsCompleted(1);
        $response = $this->whenIRequestTheListOfTasks();
        $this->thenICanSeeAddedTasksInTheList(
            [
                '[√] 1. Write a test that fails',
                '[ ] 2. Write code to make the test pass',
            ],
            $response
        );
    }

    /** @test */
    public function asUserITryToAddTaskWithInvalidPayload(): void
    {
        $this->client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['bad payload'], JSON_THROW_ON_ERROR)
        );

        $response = $this->client->getResponse();

        self::assertEquals(400, $response->getStatusCode());

        $body = json_decode($response->getContent(), true);

        self::assertEquals('Invalid payload', $body['error']);
    }

    private function givenIRequestToCreateATaskWithDescription(string $taskDescription): Response
    {
        return $this->apiCreateTaskWithDescription($taskDescription);
    }

    private function apiCreateTaskWithDescription(string $taskDescription): Response
    {
        $this->client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => $taskDescription], JSON_THROW_ON_ERROR)
        );

        return $this->client->getResponse();
    }

    private function whenIRequestTheListOfTasks(): Response
    {
        $response = $this->apiGetTasksList();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        return $response;
    }

    private function apiGetTasksList(): Response
    {
        $this->client->request(
            'GET',
            '/api/todo'
        );

        return $this->client->getResponse();
    }

    private function thenICanSeeAddedTasksInTheList(array $expectedTasks, Response $response): void
    {
        $taskList = json_decode($response->getContent(), true);

        self::assertEquals($expectedTasks, $taskList);
    }

    private function givenIHaveAddedTasks($tasks): void
    {
        foreach ($tasks as $task) {
            $this->apiCreateTaskWithDescription($task);
        }
    }

    private function givenIMarkATaskAsCompleted(int $taskId): void
    {
        $patchResponse = $this->apiMarkTaskCompleted($taskId);

        self::assertEquals(Response::HTTP_OK, $patchResponse->getStatusCode());
    }

    private function apiMarkTaskCompleted(int $taskId): Response
    {
        $this->client->request(
            'PATCH',
            '/api/todo/' . $taskId . '',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['completed' => true], JSON_THROW_ON_ERROR)

        );

        return $this->client->getResponse();
    }

    protected function setUp(): void
    {
        $this->resetRepositoryData();

        $this->client = self::createClient();
    }

    private function resetRepositoryData(): void
    {
        if (file_exists('repository.data')) {
            unlink('repository.data');
        }
    }

    protected function tearDown(): void
    {
        $this->resetRepositoryData();
    }
}
