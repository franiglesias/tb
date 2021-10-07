<?php
declare (strict_types=1);

namespace App\StateMachine\Post\Account\AccountState;

use App\StateMachine\Post\Account\Account;

final class Funded extends AccountState
{
    public function withdraw(
        Account $account,
        float $withdrawal
    ): AccountState {
        if ($account->hasEnoughFundsForWithdrawal($withdrawal)) {
            return $this;
        }

        if ($account->isWithdrawalOverLimit($withdrawal)) {
            throw new OverdrawnNotAllowed();
        }

        return new Overdrawn();
    }
}
