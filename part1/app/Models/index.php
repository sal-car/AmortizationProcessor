<?php
declare(strict_types=1);
namespace PaymentGateway\Models;

require_once __DIR__ ."/Project.php";
require_once __DIR__ ."/Amortization.php";
require_once __DIR__ ."/AmortizationState.php";
require_once __DIR__ ."/PaymentState.php";
require_once __DIR__ ."/../factory.php";



// var_dump($projects);

function processPayments (array $projects) {
    $currentDate = new \DateTime();
    $emailList = [];
    foreach ($projects as $project) {
        // var_dump($project->amortizations);

        // Filter the amortizations to only include the ones with state pending or delayed
         $amortizations = array_filter($project->amortizations, function ($amortization) {
            $state = $amortization->getState();
            return $state === "STATE_PENDING" || $state === "STATE_DELAYED";
        });

        // If there are no pending/delayed amortizations, go to the next project
        if(empty($amortizations)) {
            continue;
        }

        foreach ($amortizations as $amortization) {
            $scheduledDate = $amortization->getScheduledDate();

            if($scheduledDate > $currentDate) {
                echo "The scheduled date is after the current date.";
            } else {
            echo "The scheduled date is the same as or before the current date.";
            };




    };
    }}

    processPayments($projects);