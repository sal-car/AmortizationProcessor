<?php
declare(strict_types=1);

namespace PaymentGateway\Models;

require_once __DIR__ ."/Wallet.php";

class Project {
    public string $promoter;
    private Wallet $wallet;
    public array $amortizations = [];

    public function __construct(string $promoter, int $initialBalance) { 
        $this->promoter = $promoter;
        $this->wallet = new Wallet($initialBalance);
    }

    public function addAmortizations(array $amortizations): void {
        $this->amortizations = array_merge($this->amortizations, $amortizations);
     }

    public function getPromoter(): string {
        return $this->promoter;
    }

    public function getWalletBalance(): int {
        return $this->wallet->getBalance();
    }

    public function addFunds(int $amount): void {
        $this->wallet->increase($amount);
    }

    public function withdraw(int $amount): void {
        $this->wallet->decrease($amount);
    }
}
