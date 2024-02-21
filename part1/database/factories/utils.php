<?php

declare(strict_types= 1);

function generateRandomDate(): \DateTime {
    $startDate = new \DateTime();
    $startDate->modify('-30 days'); // 30 days before the current date
    $endDate = new \DateTime();
    $endDate->modify('+30 days'); // 30 days after the current date
    $randomTimestamp = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());
    $randomDate = new \DateTime();
    $randomDate->setTimestamp($randomTimestamp);
    // var_dump($randomDate);
    return $randomDate;
}