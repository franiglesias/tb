<?php
declare (strict_types=1);

namespace App\StateMachine\Post\Account\AccountState;

use App\StateMachine\Post\Account\Account;

final class Overdrawn extends AccountState
{
    public function withdraw(
        Account $account,
        float $withdrawal
    ): AccountState {
        if ($account->isWithdrawalOverLimit($withdrawal)) {
            throw new OverdrawnNotAllowed();
        }

        return new self();
    }

    public function deposit(float $expectedBalance): AccountState
    {
        if ($expectedBalance >= 0.0) {
            return new Funded();
        }

        return $this;
    }
}
