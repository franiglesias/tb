<?php
declare (strict_types=1);

namespace App\StateMachine\Post\Account;

use App\StateMachine\Post\Account\AccountState\AccountState;
use App\StateMachine\Post\Account\AccountState\Activated;

class Account
{

    private array $movements;
    private AccountState $state;
    private float $overdrawnLimit;

    public function __construct(float $firstDeposit = 0.0, float $overdrawnLimit = 150.0)
    {
        $this->movements = [];
        $this->state = new Activated();
        $this->overdrawnLimit = $overdrawnLimit;

        $this->deposit($firstDeposit);
    }

    public function deposit(float $amount): void
    {
        $expectedBalance = $this->balance() + $amount;

        $this->state = $this->state->deposit($expectedBalance);
        $this->movements[] = $amount;
    }

    public function withdraw(float $withdrawal): void
    {
        $this->state = $this->state->withdraw(
            $this,
            $withdrawal
        );

        $this->movements[] = -1 * $withdrawal;
    }

    public function balance(): float
    {
        return array_sum($this->movements);
    }

    public function status(): AccountState
    {
        return $this->state;
    }

    public function overdrawnLimit(): float
    {
        return $this->overdrawnLimit;
    }

    public function isWithdrawalOverLimit(float $withdrawal): bool
    {
        $expectedBalance = $this->balance() - $withdrawal;

        return $expectedBalance < -$this->overdrawnLimit;
    }

    public function hasEnoughFundsForWithdrawal(float $withdrawal): bool
    {
        $expectedBalance = $this->balance() - $withdrawal;

        return $expectedBalance >= 0.0;
    }
}
