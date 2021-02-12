<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use App\Lib\FileStorageEngine;
use App\TodoList\Domain\Task;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TodoListAcceptanceTest extends WebTestCase
{
    private Client $client;

    /** @test */
    public function asUserIWantToAddTaskToAToDoList(): void
    {
        $response = $this->whenWeRequestToCreateATaskWithDescription('Write a test that fails');

        $this->thenResponseShouldBeSuccesful($response);

        $this->thenTheTaskIsStored();
    }


    protected function setUp(): void
    {
        $this->resetRepositoryData();

        $this->client = self::createClient();
    }

    protected function tearDown(): void
    {
        $this->resetRepositoryData();
    }

    private function resetRepositoryData(): void
    {
        if (file_exists('repository.data')) {
            unlink('repository.data');
        }
    }

    private function whenWeRequestToCreateATaskWithDescription(string $taskDescription): Response
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

    private function thenResponseShouldBeSuccesful(Response $response): void
    {
        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    private function thenTheTaskIsStored(): void
    {
        $storage = new FileStorageEngine('repository.data');
        $tasks = $storage->loadObjects(Task::class);

        self::assertCount(1, $tasks);
        self::assertEquals(1, $tasks[1]->id());
    }
}
