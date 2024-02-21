<?php

declare(strict_types=1);

namespace PaymentGateway\Models;

class PaymentState {
    public static array $allStates = ['STATE_PAID' => 'paid', 'STATE_PENDING' => 'pending'];
    public static string $state = 'STATE_PENDING';

    public function setPaymentState(string $paymentState): self {
        if (!isset(self::$allStates[$paymentState])) {
            throw new \InvalidArgumentException("Invalid payment state: $paymentState");
     }

     self::$state = $paymentState;

     return $this;

    }

}