<?php


namespace App\Katas\FizzBuzz;


class FizzBuzz
{

    public function generate(): array
    {
        $numbers_list = [];

        foreach (range(1, 100) as $number) {
            if ($number % 3 === 0) {
                $numbers_list[] = 'Fizz';
                continue;
            }

            if ($number % 5 === 0) {
                $numbers_list[] = 'Buzz';
                continue;
            }


            $numbers_list[] = $number;
        }

        return $numbers_list;
    }
}
