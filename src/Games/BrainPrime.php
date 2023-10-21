<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\startGame;

use const BrainGames\Engine\ROUND_COUNT;

const BRAIN_PRIME = 'brain-prime';

function startBrainPrime(): void
{
    startGame(BRAIN_PRIME);
}

function getBrainPrimeData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $number = getRandomNumber(2);
        $isPrime = isPrime($number) ? 'yes' : 'no';

        $gameData[] = [$number, $isPrime];
    }

    return $gameData;
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
