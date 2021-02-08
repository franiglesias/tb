<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Persistence;

use App\Domain\Task;
use App\Infrastructure\Persistence\FileTaskRepository;
use App\Lib\FileStorageEngine;
use PHPUnit\Framework\TestCase;

class FileTaskRepositoryTest extends TestCase
{
    private FileStorageEngine $storageEngine;
    private FileTaskRepository $taskRepository;

    protected function setUp(): void
    {
        $this->storageEngine = $this->createMock(FileStorageEngine::class);
        $this->taskRepository = new FileTaskRepository($this->storageEngine);
    }


    /** @test */
    public function shouldBeAbleToStoreTasks(): void
    {
        $task = new Task(1, 'TaskDescription');
        $this->storageEngine
            ->method('loadObjects')
            ->with(Task::class)
            ->willReturn([]);
        $this->storageEngine
            ->expects(self::once())
            ->method('persistObjects')
            ->with([1 => $task]);

        $this->taskRepository->store($task);
    }

    /** @test */
    public function shouldProvideNextIdentity(): void
    {
        $this->storageEngine
            ->method('loadObjects')
            ->with(Task::class)
            ->willReturn([]);

        $id = $this->taskRepository->nextId();
        self::assertEquals(1, $id);
    }

    /** @test */
    public function shouldRetrieveTasksById(): void
    {
        $task1 = new Task(1, 'Task 1');
        $task2 = new Task(2, 'Task 2');
        $this->storageEngine
            ->method('loadObjects')
            ->with(Task::class)
            ->willReturn([1 => $task1, 2 => $task2]);

        $task = $this->taskRepository->retrieve(2);

        self::assertEquals($task2, $task);
    }

    /** @test */
    public function shouldRetrieveAllTasks(): void
    {
        $expectedTasks = [
            1 => new Task(1, 'Task 1'),
            2 => new Task(2, 'Task 2'),
        ];

        $this->storageEngine
            ->method('loadObjects')
            ->with(Task::class)
            ->willReturn($expectedTasks);

        $tasks = $this->taskRepository->findAll();

        self::assertEquals($expectedTasks, $tasks);
    }
}
