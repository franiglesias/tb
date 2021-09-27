<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListAcceptanceTest extends WebTestCase
{
    /** @test */
    public function asUserICanAddATaskToTheList(): void
    {
        $client = self::createClient();
        $client->disableReboot();

        $payload = [
            'task' => 'Write a test that fails'
        ];
        $client->request(
            'POST',
            '/api/todo',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        $client->request(
            'GET',
            '/api/todo',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $response = $client->getResponse();
        $contents = $response->getContent();
        $tasks = json_decode($contents, true);

        $expected = [
            '[ ] 1. Write a test that fails',
        ];

        self::assertEquals($expected, $tasks);
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
