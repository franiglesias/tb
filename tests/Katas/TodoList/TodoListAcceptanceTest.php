<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListAcceptanceTest extends WebTestCase
{
    /** @test */
    public function shouldAllowAddingTaskCompleteAndRetrieveTheList(): void
    {
        $expectedList = [
            '[√] 1. Write a test that fails',
            '[ ] 2. Write Production code that makes the test pass',
            '[ ] 3. Refactor if there is opportunity',
        ];

        $client = self::createClient();

        $taskDescription = 'Write a test that fails';
        $client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => $taskDescription])
        );

        $taskDescription = 'Write Production code that makes the test pass';
        $client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => $taskDescription])
        );

        $taskDescription = 'Refactor if there is opportunity';
        $client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['task' => $taskDescription])
        );

        $taskId = 1;
        $client->request(
            'PATCH',
            '/api/todo/' . $taskId,
            [],
            [],
            ['CONTENT-TYPE' => 'json/application'],
            json_encode(['done' => true])
        );

        $client->request('GET', '/api/todo');
        $response = $client->getResponse();
        $list = json_decode($response->getContent(), true);

        self::assertEquals($list, $expectedList);
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
