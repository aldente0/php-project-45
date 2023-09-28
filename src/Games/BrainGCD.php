<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;

function startBrainGCD(): int
{
    $quantityCorrectAnswers = 0;

    do {
        $multiplier = getRandomNumber(2, 5);
        $firstNumber = getRandomNumber(1, 50) * $multiplier;
        $secondNumber = getRandomNumber(1, 50) * $multiplier;
        $numbers = [$secondNumber, $firstNumber];
        $gcd = getGCD($firstNumber, $secondNumber, $multiplier);

        [$quantityCorrectAnswers, $isCorrectAnswer] = startNextQuiz(
            $quantityCorrectAnswers,
            forCreateAnswer: $numbers,
            expectedAnswer: $gcd
        );
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
}

function getGCD(int $num1, int $num2, int $minGCD): int
{
    $gcd = $minGCD;

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
