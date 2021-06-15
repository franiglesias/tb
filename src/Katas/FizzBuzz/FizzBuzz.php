<?php

declare(strict_types=1);

namespace App\Katas\FizzBuzz;

class FizzBuzz
{

    private const NUMBER_OF_ELEMENTS = 100;

    public function generate(): array
    {
        $listOfNumbers = [];

        for ($number = 1; $number <= self::NUMBER_OF_ELEMENTS; $number++) {
            $listOfNumbers[$number - 1] = $this->representation($number);
        }

        return $listOfNumbers;
    }

    private function representation(int $number)
    {
        $representation = $number;

        if ($this->isMultipleOfThree($number)) {
            $representation = 'Fizz';
        }

        if ($number === 5) {
            $representation = 'Buzz';
        }

        return $representation;
    }

    private function isMultipleOfThree(int $number): bool
    {
        return $number % 3 === 0;
    }
}
