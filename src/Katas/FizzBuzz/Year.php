<?php

declare(strict_types=1);

namespace App\Katas\FizzBuzz;

class Year
{

    private int $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function isLeap(): bool
    {
        if ($this->isDivisibleBy(400)) {
            return true;
        }

        return $this->isDivisibleBy(4) && !$this->isDivisibleBy(100);
    }

    private function isDivisibleBy(int $divisor): bool
    {
        return $this->year % $divisor === 0;
    }
}
