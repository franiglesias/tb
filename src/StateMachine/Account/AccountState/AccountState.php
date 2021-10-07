<?php
declare (strict_types=1);

namespace App\StateMachine\Post\Account\AccountState;

use App\StateMachine\Post\Account\Account;

abstract class AccountState
{
    public static function activate(): Activated
    {
        return new Activated();
    }

    public function withdraw(
        Account $account,
        float $withdrawal
    ): AccountState {
        throw new OverdrawnNotAllowed();
    }

    public function deposit(float $expectedBalance): AccountState
    {
        return new Funded();
    }
}
