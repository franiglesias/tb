<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Domain;

use App\TodoList\Domain\Task;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class TaskTest extends TestCase
{
    /** @test */
    public function shouldNotAllowEmptyDescription(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Task(1, '');
    }

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

    /** @test */
    public function shouldUpdateDescription(): void
    {
        $expected = '[ ] 1. New Task Description';
        $task = new Task(1, 'Task Description');
        $task->updateDescription('New Task Description');

        $representation = $task->representedAs('[:check] :id. :description');

        self::assertEquals($expected, $representation);
    }

    /** @test */
    public function shouldFailUpdatingWithInvalidDescription(): void
    {
        $expected = '[ ] 1. New Task Description';
        $task = new Task(1, 'Task Description');
        $task->updateDescription('New Task Description');

        $representation = $task->representedAs('[:check] :id. :description');

        self::assertEquals($expected, $representation);
    }

}
