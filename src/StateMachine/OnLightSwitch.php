<?php
declare (strict_types=1);

namespace App\StateMachine;

final class OnLightSwitch extends BaseLightSwitch
{
    public function switchOff(): LightSwitch
    {
        return new OffLightSwitch();
    }

    public function isOn(): bool
    {
        return true;
    }
}
