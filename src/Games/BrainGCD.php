<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\startGame;

const BRAIN_GCD_RULES = 'Find the greatest common divisor of given numbers.';

function startBrainGCD(): void
{
    startGame(
        BRAIN_GCD_RULES,
        function () {
            // without $multiplier, gcd is often equal to 1
            $multiplier = rand(1, 10);
            $firstNumber = rand(1, 50) * $multiplier;
            $secondNumber = rand(1, 50) * $multiplier;
            $numbers = [$secondNumber, $firstNumber];
            $gcd = getGCD($firstNumber, $secondNumber);

            return [$numbers, $gcd];
        }
    );
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
