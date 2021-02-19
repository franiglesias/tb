<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use App\Lib\FileStorageEngine;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListAcceptanceTest extends WebTestCase
{
    /** @test */
    public function asUserIWantToAddTaskToTheList(): void
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

        self::assertEquals(201,$response->getStatusCode());

        $storage = $client->getContainer()->get(FileStorageEngine::class);

        self::assertCount(1, $storage->loadObjects(Task::class));
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
