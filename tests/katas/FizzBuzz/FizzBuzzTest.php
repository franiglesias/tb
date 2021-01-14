<?php

namespace App\Tests\Katas\FizzBuzz;

use App\Katas\FizzBuzz\FizzBuzz;
use PHPUnit\Framework\TestCase;

/**
 * Our target is to write a program that prints the numbers from 1 to 100 with the following rules:
 *
 * If number is 3 or multiple of 3 should be replaced with 'Fizz'
 * If number is 5 or multiple of 5 should be replaced with 'Buzz'
 * If number is multiple of 3 and 5 should be replaced with 'FizzBuzz'
 *
 * TDD Rules:
 *
 * You can't write any production code until you have first written a failing unit test.
 * You can't write more of a unit test than is sufficient to fail, and not compiling is failing.
 * You can't write more production code than is sufficient to pass the currently failing unit test.
 *
 * */
class FizzBuzzTest extends TestCase
{
    private const NUMBERS_IN_LIST = 100;
    private $fb;

    protected function setUp(): void
    {
        $this->fb = new FizzBuzz();
    }


    /** @test */
    public function shouldHave100elements(): void
    {
        self::assertCount(self::NUMBERS_IN_LIST, $this->fb->generate());
    }

    /**
     * @test
     * @dataProvider examples
     * @param $number
     * @param $representation
     */
    public function shouldOneShouldShowAsIs($number, $representation): void
    {
        $this->assertThatNumberIsRepresentedWith($number, $representation);
    }

    public function examples(): array
    {
        return [
            [1, '1'],
            [3, 'Fizz'],
            [5, 'Buzz'],
            [6, 'Fizz'],
            [10, 'Buzz']
        ];
    }

    private function assertThatNumberIsRepresentedWith($number, $representation): void
    {
        self::assertEquals($representation, $this->fb->generate()[$number - 1]);
    }
}
