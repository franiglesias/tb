<?php

declare(strict_types=1);

namespace App\Katas\FizzBuzz;

class FizzBuzz
{

    private const NUMBER_OF_ELEMENTS = 100;

    public function generate(): array
    {
        $list = [];

        for ($number = 1; $number <= self::NUMBER_OF_ELEMENTS; $number++) {
            $representation = (string)$number;

            if ($number % 3 === 0) {
                $representation = 'Fizz';
            }

            $list[] = $representation;
        }

        return $list;
    }
}
