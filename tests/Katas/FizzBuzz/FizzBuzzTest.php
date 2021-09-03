<?php

namespace App\Tests\Katas\FizzBuzz;

use App\Katas\FizzBuzz\FizzBuzz;
use App\Katas\FizzBuzz\MultipleOf;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    private const NUMBER_OF_ELEMENTS = 100;

    /** @test */
    public function shouldHaveRequiredElements(): void
    {
        $result = $this->whenWeGenerateTheList();

        self::assertCount(self::NUMBER_OF_ELEMENTS, $result);
    }

    /** @test */
    public function shouldNumberBeRepresentAsItself(): void
    {
        $this->thenNumberWillBeRepresentedAs(1, 1);
        $this->thenNumberWillBeRepresentedAs(2, 2);
        $this->thenNumberWillBeRepresentedAs(3, 'Fizz');
        $this->thenNumberWillBeRepresentedAs(4, 4);
        $this->thenNumberWillBeRepresentedAs(5, 'Buzz');
        $this->thenNumberWillBeRepresentedAs(6, 'Fizz');
        $this->thenNumberWillBeRepresentedAs(9, 'Fizz');
        $this->thenNumberWillBeRepresentedAs(10, 'Buzz');
        $this->thenNumberWillBeRepresentedAs(15, 'FizzBuzz');
        $this->thenNumberWillBeRepresentedAs(30, 'FizzBuzz');
    }

    private function whenWeGenerateTheList(): array
    {
        $rule5 = new MultipleOf(5, 'Buzz', null);
        $rule3 = new MultipleOf(3, 'Fizz', $rule5);
        $rule15 = new MultipleOf(15, 'FizzBuzz', $rule3);

        $fizzBuzz = new FizzBuzz($rule15);

        return $fizzBuzz->generate();
    }

    private function thenNumberWillBeRepresentedAs(int $number, string $representation): void
    {
        $theList = $this->whenWeGenerateTheList();
        self::assertEquals($representation, $theList[$number - 1]);
    }

}
