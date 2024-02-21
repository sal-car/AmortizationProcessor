<?php
declare(strict_types=1);

namespace PaymentGateway\Models;

class Amortization {
    public string $id;
    private int $amount;
    private string $project_id;
    private \DateTime $scheduled_date;
    public AmortizationState $state;


    public function __construct(string $id, int $amount, \DateTime $scheduled_date, string $project_id, string $state) {
        $this->id = $id;
        $this->amount = $amount;
        $this->scheduled_date = $scheduled_date;
        $this->project_id = $project_id;
        $this->state = new AmortizationState(); // Instantiating AmortizationState
        $this->setState($state); // Setting initial state
        }

    public function getId(): string {
         return $this->id; 
    }

    public function getAmount(): int {
        return $this->amount;
    }

    public function getScheduledDate(): \DateTime {
        return $this->scheduled_date;
    }

    public function getProjectId(): string {
        return $this->project_id;
    }

    public function getState(): string {
        return $this->state::$state;
    }

    public function setState(string $state): void {
        $this->state->setAmortizationState($state);
    }
}