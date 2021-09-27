<?php
declare (strict_types=1);

namespace App\StateMachine;

interface LightSwitch
{
    public function switchOn(): LightSwitch;

    public function switchOff(): LightSwitch;

    public function isOn(): bool;
}
