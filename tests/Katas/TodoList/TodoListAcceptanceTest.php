<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use App\Lib\FileStorageEngine;
use App\TodoList\Domain\Task;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TodoListAcceptanceTest extends WebTestCase
{
    /** @test */
    public function asUserIWantToAddTaskToAToDoList(): void
    {
        $client = self::createClient();

        $client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => 'Write a test that fails'], JSON_THROW_ON_ERROR)
        );

        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $storage = new FileStorageEngine('repository.data');
        $tasks = $storage->loadObjects(Task::class);

        self::assertCount(1, $tasks);
        self::assertEquals(1, $tasks[1]->id());
    }


    protected function setUp(): void
    {
        $this->resetRepositoryData();
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
}
