<?php
declare (strict_types=1);

namespace App\Tests\Infrastructure\Persistence\Memory;

use App\Domain\Task;
use App\Infrastructure\Persistence\Memory\TaskMemoryRepository;
use PHPUnit\Framework\TestCase;

class TaskMemoryRepositoryTest extends TestCase
{

    /** @test */
    public function shouldProvideNextId(): void
    {
        $taskRepository = new TaskMemoryRepository();

        self::assertEquals(1, $taskRepository->nextId());
    }

    /** @test */
    public function shouldStoreATask(): void
    {
        $taskRepository = new TaskMemoryRepository();

        $taskRepository->store(new Task(1, 'Write a test that fails'));

        self::assertEquals(2, $taskRepository->nextId());
    }

    /** @test */
    public function shouldStoreSeveralTasksUpdatingNextId(): void
    {
        $taskRepository = new TaskMemoryRepository();

        $taskRepository->store(new Task(1, 'Write a test that fails'));
        $taskRepository->store(new Task(2, 'Write production code'));
        $taskRepository->store(new Task(3, 'Refactor things'));

        self::assertEquals(4, $taskRepository->nextId());
    }

    /** @test */
    public function shouldProvideAllTasks(): void
    {
        $taskRepository = new TaskMemoryRepository();

        $taskRepository->store(new Task(1, 'Write a test that fails'));
        $taskRepository->store(new Task(2, 'Write production code'));
        $taskRepository->store(new Task(3, 'Refactor things'));

        $expected = [
            1 => new Task(1, 'Write a test that fails'),
            2 => new Task(2, 'Write production code'),
            3 => new Task(3, 'Refactor things'),
        ];

        self::assertEquals($expected, $taskRepository->findAll());
    }

}
