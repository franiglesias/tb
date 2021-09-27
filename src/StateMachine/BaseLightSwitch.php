<?php
declare (strict_types=1);

namespace App\StateMachine;

abstract class BaseLightSwitch implements LightSwitch
{

    public function switchOn(): LightSwitch
    {
        return $this;
    }

    public function switchOff(): LightSwitch
    {
        return $this;
    }

    abstract public function isOn(): bool;
}
