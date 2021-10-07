<?php
declare (strict_types=1);

namespace App\Tests\StateMachine\Post\Account;

use App\StateMachine\Post\Account\Account;
use App\StateMachine\Post\Account\AccountState\Funded;
use App\StateMachine\Post\Account\AccountState\Overdrawn;
use App\StateMachine\Post\Account\AccountState\OverdrawnNotAllowed;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    /** @test */
    public function shouldAllowWithdrawWithEnoughFunds(): void
    {
        $account = new Account(1000.0);
        $account->withdraw(100.0);

        self::assertEquals(900.0, $account->balance());
    }

    /** @test */
    public function shouldAllowWithdrawWithoutEnoughFundsButInsideAllowed(): void
    {
        $account = new Account(200.0);
        $account->withdraw(300.0);

        self::assertEquals(-100.0, $account->balance());
        self::assertEquals(new Overdrawn(), $account->status());
    }

    /** @test */
    public function shouldNotAllowWithdrawOverTheLimit(): void
    {
        $account = new Account(200.0);

        try {
            $account->withdraw(400.0);
        } catch (OverdrawnNotAllowed $overdrawnNotAllowed) {
            self::assertEquals(200.0, $account->balance());
            self::assertEquals(new Funded(), $account->status());
        }
    }

    /** @test */
    public function shouldAllowWithdrawWithoutEnoughFundsInOverdrawnAccountNotExceedingLimit(): void
    {
        $account = new Account(200.0);
        $account->withdraw(250.0);
        $account->withdraw(50.0);

        self::assertEquals(-100.0, $account->balance());
        self::assertEquals(new Overdrawn(), $account->status());
    }

    /** @test */
    public function shouldNotAllowWithdrawOverTheLimitOnOverdrawnAccounts(): void
    {
        $account = new Account(200.0);
        $account->withdraw(250.0);

        try {
            $account->withdraw(400.0);
        } catch (OverdrawnNotAllowed $overdrawnNotAllowed) {
            self::assertEquals(-50.0, $account->balance());
            self::assertEquals(new Overdrawn(), $account->status());
        }
    }

    /** @test */
    public function shouldKeepOverdrawnAccountWhenDepositIsNotEnough(): void
    {
        $account = new Account(200.0);
        $account->withdraw(340.0);
        $account->deposit(100.0);

        self::assertEquals(-40.0, $account->balance());
        self::assertEquals(new Overdrawn(), $account->status());
    }

    /** @test */
    public function shouldTransformToFundedIfDepositIsBigEnough(): void
    {
        $account = new Account(200.0);
        $account->withdraw(340.0);
        $account->deposit(200.0);

        self::assertEquals(60.0, $account->balance());
        self::assertEquals(new Funded(), $account->status());
    }
}
