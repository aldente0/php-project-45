<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\startGame;

const RULES = 'Find the greatest common divisor of given numbers.';

function startApp(): void
{
    startGame(
        RULES,
        function () {
            $firstNumber = rand(21, 40);
            $secondNumber = rand(1, 20);
            $numbers = implode(' ', [$secondNumber, $firstNumber]);
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
