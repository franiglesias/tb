<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListAcceptanceTest extends WebTestCase
{



    protected function setUp(): void
    {
        $this->resetRepositoryData();
    }

    protected function tearDown(): void
    {
        $this->resetRepositoryData();
    }

    private function resetRepositoryData(): void
    {
        if (file_exists('repository.data')) {
            unlink('repository.data');
        }
    }


}
