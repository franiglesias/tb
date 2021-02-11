<?php

declare(strict_types=1);

namespace App\Tests\TodoList\Infrastructure\Persistence;

use App\Lib\FileStorageEngine;
use App\TodoList\Domain\Task;
use App\TodoList\Domain\TaskRepository;
use App\TodoList\Infrastructure\Persistence\FileTaskRepository;
use PHPUnit\Framework\TestCase;

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
}
