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
            $gcd = 1;

            for ($i = $secondNumber; $i > $gcd; $i--) {
                if (($firstNumber % $i == 0) && ($secondNumber % $i == 0)) {
                    $gcd = $i;
                }
            }

            return [$numbers, $gcd];
        }
    );
}
