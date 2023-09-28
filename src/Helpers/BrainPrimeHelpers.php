<?php

namespace BrainGames\Helpers\BrainPrimeHelpers;

function isPrime(int $number): bool
{
    $isPrime = true;

    for ($i = 2; $isPrime && $i < $number; $i++) {
        if ($number % $i === 0) {
            $isPrime = false;
        }
    }

    return $isPrime;
}

function getNumberSQRT(int $number): int
{
    return ceil(sqrt($number));
}
