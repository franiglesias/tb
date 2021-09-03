<?php
declare (strict_types=1);

namespace App\Katas\FizzBuzz;

class MultipleOf
{
    private int $divisor;
    private string $result;
    private ?MultipleOf $next;

    public function __construct($divisor, $result, ?MultipleOf $next = null)
    {
        $this->divisor = $divisor;
        $this->result = $result;
        $this->next = $next;
    }

    public function apply(int $number): string
    {
        if ($this->isMultipleOf($number)) {
            return $this->result;
        }

        if ($this->next) {
            return $this->next->apply($number);
        }

        return (string)$number;
    }

    private function isMultipleOf(int $number): bool
    {
        return $number % $this->divisor === 0;
    }
}
