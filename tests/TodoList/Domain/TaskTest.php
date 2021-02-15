<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Domain;

use App\TodoList\Domain\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    /** @test */
    public function shouldProvideRepresentation(): void
    {
        $expected = '[ ] 1. Task Description';
        $task = new Task(1, 'Task Description');

        $representation = $task->representedAs('[:check] :id. :description');

        self::assertEquals($expected, $representation);
    }

    /** @test */
    public function shouldMarkTaskCompleted(): void
    {
        $expected = '[√] 1. Task Description';
        $task = new Task(1, 'Task Description');
        $task->markCompleted();

        $representation = $task->representedAs('[:check] :id. :description');

        self::assertEquals($expected, $representation);
    }


}
