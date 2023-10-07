<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\getBrainGCDData;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\play;
use function BrainGames\Engine\startNextQuiz;
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
