<?php

namespace App\Http\Controllers;
use Database\Factories\ProjectFactory;

class PaymentController extends Controller
{
    public function __invoke()
    {   

    /*--------GENERATE A MOCK DATABASE------- */

    // Create 4 projects with 5 amortizations each
    [$projects, $payments] = ProjectFactory::createProjects(4);
    
    $currentDate = new \DateTime();
    $emailList = [];
    $paidAmortizations = [];
    foreach ($projects as $project) {
        /* 
        Filter the amortizations to only include the ones with state pending or delayed,
        as these are the only ones of interest.

        If there are no pending/delayed amortizations for the current project,
        continue to the next one.
        */
         $amortizations = array_filter($project->amortizations, function ($amortization) {
            $state = $amortization->getState();
            return $state === "STATE_PENDING" || $state === "STATE_DELAYED";
        });

        if(empty($amortizations)) {
            continue;
        }

        /* 
        For each pending/delayed amortization, check if they are scheduled to be paid
        before/on the same date, or if they're delayed.

            -The amortization is delayed => we get the associated payment profile and
            the payment promoter, and put them in the email list.

            -The amortization is not delayed => we check if we have enough balance
            in the project's wallet to pay the amortization.

            -The wallet does not have enough balance => go to the next amortization

            -The wallet has enough balance => withdraw the amount from the wallet, get the
            associated payments and set their state to paid; set amortization state to paid.


        ***NOTE: this is a bad solution time-complexity-wise, as it introduces inner loops
        which could be refactored to be made in a batch call outside of both the amortization &
        project loop. Because of time constraints however, I will keep it like this for now.
        */
        foreach ($amortizations as $amortization) {
            $scheduledDate = $amortization->getScheduledDate();
            $id = $amortization->getId();

            // Get payments associated with current amortization
            $associatedPayments = array_filter($payments, function ($payment) use ($id) {
            return $payment->getAmortizationId() == $id;
            });

            if(empty($associatedPayments)) {
                echo "No associated payments";   
            }

            // The amortization is delayed => we get the associated payment profiles and
            // the payment promoter, and put them in the email list.
            if($scheduledDate < $currentDate) {
                
                $associatedProfiles = array_map(function ($payment) { 
                    return $payment->getProfileId();
                }, $associatedPayments); 

                if(empty($associatedProfiles)) {
                    echo "No associated profiles";
                }

                $emailList[] = ["state_is_delayed" => ["promoter" => $project->getPromoter(), "profiles" => $associatedProfiles, "amortization" => $amortization->getId()]];

                // Set the amortization state as delayed
                $amortization->setState("STATE_DELAYED");

            } else {
                echo "The scheduled date is the same as or before the current date.";
                // The amortization is not delayed => we check if we have enough balance
                // in the project's wallet to pay the amortization.
                $walletBalance = $project->getWalletBalance();
                $amortizationAmount = $amortization->getAmount();

                if ($walletBalance < $amortizationAmount) {
                    echo "The balance is too low";
                    continue;
                } else {
                    // -The wallet has enough balance => withdraw the amount from the wallet, get the
                    // associated payments and set their state to paid; set amortization state to paid.
                    $project->withdraw($amortizationAmount);
                    $amortization->setState("STATE_PAID");
                    array_map(function ($payment) {
                        return $payment->setState("STATE_PAID");
                    }, $associatedPayments);

                    $paidAmortizations[] = $amortization->getId();
                }
        };
        }
    }
    // Return email list and list of paid amortization IDs as JSON
    return response()->json(["emailList" => $emailList, "paidAmortizations" => $paidAmortizations ]);
    }
}
