<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Persistence;

use App\Domain\Task;
use App\Infrastructure\Persistence\FileTaskRepository;
use App\Lib\FileStorageEngine;
use PHPUnit\Framework\TestCase;

class FileTaskRepositoryTest extends TestCase
{
    private $taskRepository;
    private $engine;

    protected function setUp(): void
    {
        $this->engine = $this->createMock(FileStorageEngine::class);
        $this->taskRepository = new FileTaskRepository($this->engine);
    }


    /** @test */
    public function shouldProvideNextId(): void
    {
        $this->engine
            ->method('loadObjects')
            ->willReturn([]);


        $id = $this->taskRepository->nextId();

        self::assertEquals(1, $id);
    }

    /** @test */
    public function shouldStoreATask(): void
    {
        $task = new Task(1, 'Write a test that fails');

        $this->engine
            ->method('loadObjects')
            ->willReturn([]);

        $this->engine
            ->expects(self::once())
            ->method('persistObjects')
            ->with([1 => $task]);

        $this->taskRepository->store($task);
    }


}
