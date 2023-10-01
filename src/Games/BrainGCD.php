<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Info\showResult;
use function BrainGames\Info\showRules;
use function BrainGames\Info\welcomePlayer;

const BRAIN_GSD_RULES = 'Find the greatest common divisor of given numbers.';

function startBrainGCD(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_GSD_RULES);
    $isWonGame = true;

    for ($turn = 0; isGameGoingOn($turn, $isWonGame); $turn++) {
        $multiplier = getRandomNumber(2, 5);
        $firstNumber = getRandomNumber(1, 50) * $multiplier;
        $secondNumber = getRandomNumber(1, 50) * $multiplier;
        $numbers = [$secondNumber, $firstNumber];
        $gcd = getGCD($firstNumber, $secondNumber, $multiplier);

        $isWonGame = startNextQuiz(
            forCreateQuestion: $numbers,
            expectedAnswer: $gcd
        );
    }

    showResult($isWonGame, $player);
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
