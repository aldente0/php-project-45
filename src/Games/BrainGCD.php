<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\startGame;

const RULES = 'Find the greatest common divisor of given numbers.';

function startApp(): void
{
    startGame(
        RULES,
        function () {
            $firstNumber = rand(1, 100);
            $secondNumber = rand(1, 100);

            $numbers = implode(' ', [$secondNumber, $firstNumber]);
            $gcd = getGCD($firstNumber, $secondNumber);

            return [$numbers, $gcd];
        }
    );
}

function getGCD(int $firstNumber, int $secondNumber): int
{
    $gcd = 1;
    $minNumber = min($firstNumber, $secondNumber);

    for ($i = $minNumber; $i > $gcd; $i--) {
        if (($firstNumber % $i == 0) && ($secondNumber % $i == 0)) {
            $gcd = $i;
        }
    }

    return $gcd;
}

