<?php
declare(strict_types=1);

namespace Database\Factories;
use PaymentGateway\Models\Amortization;
use PaymentGateway\Models\AmortizationState;

require_once __DIR__ ."/utils.php";
require_once __DIR__ ."/../../app/Models/Amortization.php";
require_once __DIR__ ."/../../app/Models/AmortizationState.php";

class AmortizationFactory
{
    public static function createRandomAmortization(): Amortization
    {
        $amount = rand(100, 1000); // Random amount between 100 and 1000
        $scheduled_date = new \DateTime(); // Current datetime
        $scheduled_date = generateRandomDate(); // Random date within 30 days before or after
        $project_id = uniqid('project_'); // Unique project ID
        $amortization_id = uniqid('amortization_'); // Unique amortization ID
        $state = array_rand(['STATE_PAID' => 'paid', 'STATE_PENDING' => 'pending']); // Random state
        // var_dump($state);
        $amortization = new Amortization($amortization_id, $amount, $scheduled_date, $project_id, $state);
        // var_dump($amortization);
        return $amortization;
    }
}