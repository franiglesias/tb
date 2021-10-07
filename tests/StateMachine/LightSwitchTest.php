<?php
declare (strict_types=1);

namespace App\Tests\StateMachine;

use App\StateMachine\Post\OnLightSwitch;
use PHPUnit\Framework\TestCase;

class LightSwitchTest extends TestCase
{
    /** @test */
    public function shouldSwitchOn(): void
    {
        $switch = new OnLightSwitch();

        $switch = $switch->switchOn();

        self::assertTrue($switch->isOn());
    }

    /** @test */
    public function shouldSwitchOff(): void
    {
        $switch = new OnLightSwitch();

        $switch = $switch->switchOff();

        self::assertFalse($switch->isOn());
    }
}
