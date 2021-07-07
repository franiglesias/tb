<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use App\Lib\FileStorageEngine;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TodoListAcceptanceTest extends WebTestCase
{
    private $client;

    /** @test */
    public function asUserIWantToAddTaskToTheList(): void
    {
        $taskDescription = 'Write a test that fails';

        $response = $this->createTaskWithDescription($taskDescription);

        self::assertEquals(201,$response->getStatusCode());

        $storage = $this->client->getContainer()->get(FileStorageEngine::class);

        self::assertCount(1, $storage->loadObjects(Task::class));
    }

    /** @test */
    public function asUserICannotAddTasksWithoutDescription(): void
    {
        $taskDescription = '';

        $response = $this->createTaskWithDescription($taskDescription);

        self::assertEquals(400,$response->getStatusCode());

        $storage = $this->client->getContainer()->get(FileStorageEngine::class);

        self::assertCount(0, $storage->loadObjects(Task::class));
    }

    /** @test */
    public function shouldGetAllTaskCreated(): void
    {
        $this->createTaskWithDescription('Write production code to make the test pass');
        $this->createTaskWithDescription('Refactor things');

        $this->client->request(
            'GET',
            '/api/todo'
        );

        $getResponse = $this->client->getResponse();

        self::assertEquals(200, $getResponse->getStatusCode());

        $list = json_decode($getResponse->getContent());

        $expected = [
            '[ ] 1. Write production code to make the test pass',
            '[ ] 2. Refactor things'
        ];

        self::assertEquals($expected, $list);
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

    private function createTaskWithDescription(string $taskDescription): Response
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


}
