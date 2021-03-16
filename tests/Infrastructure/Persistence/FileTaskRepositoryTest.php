<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Persistence;

use App\Domain\Task;
use App\Infrastructure\Persistence\FileTaskRepository;
use App\Lib\FileStorageEngine;
use PHPUnit\Framework\TestCase;

class FileTaskRepositoryTest extends TestCase
{
    /** @test */
    public function shouldProvideNewIdentities(): void
    {
        $storageEngine = $this->createMock(FileStorageEngine::class);


        $storageEngine
            ->method('loadObjects')
            ->willReturn([]);

        $taskRepository = new FileTaskRepository($storageEngine);

        self::assertEquals(1, $taskRepository->nextId());
    }

    /** @test */
    public function shouldAddTasks(): void
    {
        $task = new Task(1, 'Task Description');

        $storageEngine = $this->createMock(FileStorageEngine::class);
        $storageEngine
            ->method('loadObjects')
            ->willReturn([]);

        $storageEngine
            ->expects(self::once())
            ->method('persistObjects')
            ->with([1 => $task]);

        $taskRepository = new FileTaskRepository($storageEngine);

        $taskRepository->store($task);

    }


}
