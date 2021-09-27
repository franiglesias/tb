<?php
declare (strict_types=1);

namespace App\StateMachine;

final class OffLightSwitch extends BaseLightSwitch
{
    public function switchOn(): LightSwitch
    {
        return new OnLightSwitch();
    }

    public function isOn(): bool
    {
        return false;
    }
}
