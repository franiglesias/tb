<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Infrastructure\EntryPoint\Api;

use App\TodoList\Domain\Task;
use App\TodoList\Infrastructure\EntryPoint\Api\TaskListTransformer;
use PHPUnit\Framework\TestCase;

class TaskListTransformerTest extends TestCase
{
    /** @test
     * @dataProvider examplesProvider
     */
    public function shouldTransformList($tasksList, $expected): void
    {
        $taskListTransformer = new TaskListTransformer();

        $result = $taskListTransformer->transform($tasksList);

        self::assertEquals($expected, $result);
    }

    public function examplesProvider(): array
    {
        return [
          [[], []],
          [[new Task(1, 'Task Description')], ['[ ] 1. Task Description']]
        ];
    }
}
