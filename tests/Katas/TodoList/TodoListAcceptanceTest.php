<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListAcceptanceTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
        $this->client->disableReboot();
    }

    /** @test */
    public function asUserICanAddATaskToTheList(): void
    {
        $this->givenIAddedANewTaskToEmptyList(
            '/api/todo',
            [
                'task' => 'Write a test that fails'
            ]
        );

        $tasks = $this->whenIGetAllTasksFrom('/api/todo');

        $this->thenICanSeeTheAddedTask(
            [
                '[ ] 1. Write a test that fails',
            ],
            $tasks
        );
    }

    /** @test */
    public function asUserICanAddMoreThanOneTaskToTheList(): void
    {
        $expected = $this->givenIAddedSeveralTasksToTheList(
            '/api/todo',
            [
                'Write a test that fails',
                'Write code that make test pass',
                'Refactor all the things'
            ]
        );

        $tasks = $this->whenIGetAllTasksFrom('/api/todo');

        $this->thenICanSeeAllAddedTasks($expected, $tasks);
    }

    private function apiPost(string $uri, array $payload): void
    {
        $this->client->request(
            'POST',
            $uri,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload, JSON_THROW_ON_ERROR)
        );
    }

    private function apiGet(string $uri)
    {
        $this->client->request(
            'GET',
            $uri,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $response = $this->client->getResponse();
        $contents = $response->getContent();

        return json_decode($contents, true);
    }

    private function givenIAddedANewTaskToEmptyList(string $uri, array $payload): void
    {
        $this->apiPost($uri, $payload);
    }

    private function whenIGetAllTasksFrom(string $uri)
    {
        return $this->apiGet($uri);
    }

    private function thenICanSeeTheAddedTask(array $expected, $tasks): void
    {
        self::assertEquals($expected, $tasks);
    }

    private function givenIAddedSeveralTasksToTheList(string $uri, array $payloads): array
    {
        $expected = [];
        $counter = 1;
        foreach ($payloads as $taskDescription) {
            $this->apiPost($uri, ['task' => $taskDescription]);
            $expected[] = sprintf('[ ] %s. %s', $counter, $taskDescription);

            $counter++;
        }

        return $expected;
    }

    private function thenICanSeeAllAddedTasks(array $expected, $tasks): void
    {
        self::assertEquals($expected, $tasks);
    }

}
