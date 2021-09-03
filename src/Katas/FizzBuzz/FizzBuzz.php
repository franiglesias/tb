<?php

declare(strict_types=1);

namespace App\Katas\FizzBuzz;

class FizzBuzz
{

    private const NUMBER_OF_ELEMENTS = 100;
    private MultipleOf $rules;

    public function __construct(MultipleOf $rules)
    {
        $this->rules = $rules;
    }

    public function generate(): array
    {
        $listOfNumbers = [];

        for ($number = 1; $number <= self::NUMBER_OF_ELEMENTS; $number++) {
            $listOfNumbers[$number - 1] = $this->representation($number);
        }

        return $listOfNumbers;
    }

    private function representation(int $number): string
    {
        return $this->rules->apply($number);
    }
}
