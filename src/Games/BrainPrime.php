<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\startGame;

const BRAIN_PRIME = 'brain-prime';
const BRAIN_PRIME_RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function startBrainPrime(): void
{
    startGame(BRAIN_PRIME);
}

function getBrainPrimeData(): array
{
    $number = rand(2, 50);
    $isPrime = isPrime($number) ? 'yes' : 'no';

    return [$number, $isPrime];
}

function isPrime(int $number): bool
{
    $numberHalf = ceil($number / 2);

    for ($i = 2; $i <= $numberHalf; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}
