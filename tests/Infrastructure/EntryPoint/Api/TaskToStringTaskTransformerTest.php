<?php
declare (strict_types=1);

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Domain\Task;
use App\Infrastructure\EntryPoint\Api\TaskToStringTaskTransformer;
use PHPUnit\Framework\TestCase;

class TaskToStringTaskTransformerTest extends TestCase
{

    /**
     * @test
     * @dataProvider tasksProvider
     */
    public function shouldTransformATaskIntroString(Task $task, string $expected): void
    {
        $transformer = new TaskToStringTaskTransformer();

        $line = $transformer->transform($task);

        self::assertEquals($expected, $line);
    }

    public function tasksProvider(): array
    {
        return [
            'Simple task' => [new Task(1, 'Write a test that fails'), '[ ] 1. Write a test that fails'],
            'Another task' => [new Task(2, 'Write code to make test pass'), '[ ] 2. Write code to make test pass'],

        ];
    }
}
