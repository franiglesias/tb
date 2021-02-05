<?php

declare(strict_types=1);

namespace App\Tests\Katas\TodoList;

use PHPUnit\Framework\TestCase;

/**
 * OUTSIDE-IN TDD
 *
 * The goal of the exercise is to create a basic to-do list application using an outside-in TDD approach
 *
 * US 1
 *
 * As a User
 * I want to add tasks to a to-do list
 * So that I can organize my task
 *
 * POST /api/todo
 *
 * US 2
 *
 * As a User
 * I want to see the task in my to-do list
 * So that I can know what I have to do next
 *
 * GET /api/todo
 *
 * US 3
 *
 * As a User
 * I want to check a task when it is done
 * So that I can see my progress
 *
 * PATCH /api/todo/{taskId}
 *
 *
 *  TO-DO List example
 *
 *  1. Write a test that fails
 *  2. Write Production code that makes the test pass
 *  3. Refactor if there is opportunity
 */

class TodoListAcceptanceTest extends TestCase
{

}
