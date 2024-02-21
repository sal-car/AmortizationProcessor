<?php
declare(strict_types=1);

namespace PaymentGateway\Models;

class Payment {
    private int $amount;
    private string $profile_id;
    private string $amortization_id;
    private PaymentState $state;

    public function __construct(int $amount, string $profile_id, string $amortization_id, string $state) {
        $this->amount = $amount;
        $this->profile_id = $profile_id;
        $this->amortization_id = $amortization_id;
        $this->state = new PaymentState(); // Instantiating AmortizationState object directly
        $this->setState($state); // Setting the initial state
        }

        public function getProfileId(): string {
             return $this->profile_id; 
        }

        public function setState(string $state): void {
            $this->state->setPaymentState($state);
        }

        public function getAmount(): int {
            return $this->amount;
        }

        public function getAmortizationId(): string {
            return $this->amortization_id;
        }

        public function getState(): string {
            return $this->state::$state;
        }
}