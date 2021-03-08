<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use App\Lib\FileStorageEngine;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListAcceptanceTest extends WebTestCase
{
    /** @test */
    public function asUserIWantToAddTasksToATodoList(): void
    {
        self::bootKernel();

        $client = self::createClient();

        $client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'application/json'],
            json_encode(['task' => 'Write a test that fails'])
        );

        $response = $client->getResponse();

        self::assertEquals(201, $response->getStatusCode());

        $storage = self::$container->get(FileStorageEngine::class);
        $tasks = $storage->loadObjects(Task::class);

        self::assertCount(1, $tasks);
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
