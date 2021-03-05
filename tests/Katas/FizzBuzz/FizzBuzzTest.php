<?php

namespace App\Tests\Katas\FizzBuzz;

use App\Katas\FizzBuzz\FizzBuzz;
use PHPUnit\Framework\TestCase;

/**
 *
 * $list = FizzBuzz->generate()
 *
 */

class FizzBuzzTest extends TestCase
{
    private const NUMBER_OF_ELEMENTS = 100;

    /** @test
     * @doesNotPerformAssertions
     */
    public function shouldRespondToGenerateMessage(): void
    {
        (new FizzBuzz())->generate();
    }

    /** @test */
    public function shouldHaveANumberOfElements(): void
    {
        $fizzBuzz = new FizzBuzz();

        $result = $fizzBuzz->generate();

        self::assertCount(self::NUMBER_OF_ELEMENTS, $result);
    }

    /** @test */
    public function shouldNumberBeRepresentedAsItself(): void
    {
        $this->numberIsRepresentedWith(1, '1');
        $this->numberIsRepresentedWith(2, '2');
        $this->numberIsRepresentedWith(4, '4');
    }

    /** @test */
    public function shouldMultiplesOf3BeRepresentedAsFizz(): void
    {
        $this->numberIsRepresentedWith(3, 'Fizz');
        $this->numberIsRepresentedWith(6, 'Fizz');
    }


    private function numberIsRepresentedWith(int $number, string $representation): void
    {
        $fizzBuzz = new FizzBuzz();
        $result = $fizzBuzz->generate();
        self::assertSame($representation, $result[$number - 1]);
    }


}
