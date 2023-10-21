<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\startGame;

use const BrainGames\Engine\ROUND_COUNT;

const BRAIN_GCD = 'brain-gcd';

function startBrainGCD(): void
{
    startGame(BRAIN_GCD);
}

function getBrainGCDData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $multiplier = rand(2, 5);
        $firstNumber = rand(1, 50) * $multiplier;
        $secondNumber = rand(1, 50) * $multiplier;
        $numbers = [$secondNumber, $firstNumber];
        $gcd = getGCD($firstNumber, $secondNumber);

        $gameData[] = [$numbers, $gcd];
    }

    return $gameData;
}

function getGCD(int $num1, int $num2): int
{
    $gcd = 1;

    for ($i = getSmallerNumber($num1, $num2); $i > $gcd; $i--) {
        if (($num1 % $i == 0) && ($num2 % $i == 0)) {
            $gcd = $i;
        }
    }

    return $gcd;
}

function getSmallerNumber(int $num1, int $num2): int
{
    return ($num1 <= $num2) ? $num1 : $num2;
}
