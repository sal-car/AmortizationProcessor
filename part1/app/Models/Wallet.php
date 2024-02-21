<?php
declare(strict_types=1);

namespace PaymentGateway\Models;

class Wallet {
    private int $balance;

    public function __construct(int $balance) {
        $this->balance = $balance;
    }

    public function getBalance(): int {
        return $this->balance;
    }

    public function increase(int $amount): self {
        $this->balance += $amount;
        return $this;
    }

    public function decrease(int $amount): self {
        $this->balance -= $amount;
        return $this;
    }
}