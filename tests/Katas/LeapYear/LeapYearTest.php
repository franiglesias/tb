<?php

namespace App\Tests\Katas\LeapYear;

use App\Katas\FizzBuzz\Year;
use PHPUnit\Framework\TestCase;

class LeapYearTest extends TestCase
{
    /** @test
     * @doesNotPerformAssertions
     */
    public function shouldRespondToIsLeapMessage(): void
    {
        $year = new Year(2021);
        $year->isLeap();
    }

    /** @test */
    public function shouldIdentifyNoLeapYears(): void
    {
        $year = new Year(2021);

        self::assertFalse($year->isLeap());
    }

    /** @test */
    public function shouldIdentifyLeapYears(): void
    {
        $year = new Year(1996);

        self::assertTrue($year->isLeap());
    }

    /** @test */
    public function shouldIdentifySpecialCommonYears(): void
    {
        $year = new Year(1900);

        self::assertFalse($year->isLeap());
    }

    /** @test */
    public function shouldIdentifySpecialLeapYears(): void
    {
        $year = new Year(2000);

        self::assertTrue($year->isLeap());
    }
}
