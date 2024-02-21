<?php
declare(strict_types=1);

namespace Database\Factories;
use PaymentGateway\Models\Project;
use PaymentGateway\Models\Payment;
class ProjectFactory
{
    public static function createProjects(int $numProjects): array
    {
        $projects = [];
        $payments = [];

        for ($i = 0; $i < $numProjects; $i++) {
            $promoter = "Promoter " . ($i + 1);
            $initialBalance = rand(1000, 10000); // Random initial balance between 1000 and 10 000
            $project = new Project($promoter, $initialBalance);

            $amortizations = [];
            for ($j = 0; $j < 5; $j++) {
                $amortization = AmortizationFactory::createRandomAmortization();
                $payment = new Payment($amortization->getAmount(), uniqid('profile_'), $amortization->getId(), $amortization->getState());
                $payments[] = $payment;
                $amortizations[] = $amortization;
            }
            $project->addAmortizations($amortizations);
            $projects[] = $project;
        }
        return [$projects, $payments];
    }
}
