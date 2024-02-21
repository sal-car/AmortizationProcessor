<?php
declare(strict_types=1);

namespace PaymentGateway\Models;


class AmortizationState {
    public static array $allStates = ['STATE_PAID' => 'paid', 'STATE_PENDING' => 'pending', 'STATE_DELAYED' => 'delayed'];
    public static string $state = 'STATE_PENDING';

    public function setAmortizationState(string $amortizationState): self {

        if (!isset(self::$allStates[$amortizationState])) {
            throw new \InvalidArgumentException("Invalid amortization state: $amortizationState");
        }
        
     self::$state = $amortizationState;

     return $this;

    }

}