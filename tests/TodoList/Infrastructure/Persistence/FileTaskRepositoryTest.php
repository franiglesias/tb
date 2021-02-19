<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Infrastructure\Persistence;

use App\Lib\FileStorageEngine;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use App\TodoList\Infrastructure\Persistence\FileTaskRepository;
use PHPUnit\Framework\TestCase;
use OutOfBoundsException;

class FileTaskRepositoryTest extends TestCase
{
    private FileStorageEngine $fileStorageEngine;
    private TaskRepository $taskRepository;

    public function setUp(): void
    {
        $this->fileStorageEngine = $this->createMock(FileStorageEngine::class);
        $this->taskRepository = new FileTaskRepository($this->fileStorageEngine);
    }

    /** @test */
    public function shouldProvideNextIdentityCountingExistingObjects(): void
    {
        $this->fileStorageEngine
            ->method('loadObjects')
            ->willReturn(
                [],
                ['Task'],
                ['Task', 'Task']
            );

        self::assertEquals(1, $this->taskRepository->nextIdentity());
        self::assertEquals(2, $this->taskRepository->nextIdentity());
        self::assertEquals(3, $this->taskRepository->nextIdentity());
    }

    /** @test */
    public function shouldStoreATask(): void
    {
        $task = new Task(1, 'Task Description');

        $this->fileStorageEngine
            ->method('loadObjects')
            ->willReturn([]);
        $this->fileStorageEngine
            ->expects(self::once())
            ->method('persistObjects')
            ->with([1 => $task]);

        $this->taskRepository->store($task);
    }

    /** @test */
    public function shouldGetStoredTasks(): void
    {
        $storedTasks = [
            1 => new Task(1, 'Write a test that fails'),
            2 => new Task(2, 'Write code to make the test pass'),
        ];

        $this->fileStorageEngine
            ->method('loadObjects')
            ->willReturn(
                $storedTasks
            );

        self::assertEquals($storedTasks, $this->taskRepository->findAll());
    }

    /** @test */
    public function shouldRetrieveATaskByItsId(): void
    {
        $expectedTask = new Task(1, 'Write a test that fails');

        $storedTasks = [
            1 => $expectedTask,
            2 => new Task(2, 'Write code to make the test pass'),
        ];

        $this->fileStorageEngine
            ->method('loadObjects')
            ->willReturn(
                $storedTasks
            );

        self::assertEquals($expectedTask, $this->taskRepository->retrieve(1));
    }

    /** @test */
    public function shouldFailIfTaskNotFound(): void
    {
        $storedTasks = [
            1 => new Task(1, 'Write a test that fails'),
            2 => new Task(2, 'Write code to make the test pass'),
        ];

        $this->fileStorageEngine
            ->method('loadObjects')
            ->willReturn(
                $storedTasks
            );

        $this->expectException(OutOfBoundsException::class);
        $this->taskRepository->retrieve(3);
    }
}
