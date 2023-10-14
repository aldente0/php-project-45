<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\play;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;
use function BrainGames\Engine\welcomePlayer;

const BRAIN_GSD_RULES = 'Find the greatest common divisor of given numbers.';

function startBrainGCD(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_GSD_RULES);

    $gameData = getBrainGCDData();
    $isWonGame = play($gameData);
    
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

function getBrainGCDData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $multiplier = getRandomNumber(2, 5);
        $firstNumber = getRandomNumber(1, 50) * $multiplier;
        $secondNumber = getRandomNumber(1, 50) * $multiplier;
        $numbers = [$secondNumber, $firstNumber];
        $gcd = getGCD($firstNumber, $secondNumber, $multiplier);

        $gameData[] = [$numbers, $gcd];
    }

    return $gameData;
}
