<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Info\welcomePlayer;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Info\showResult;
use function BrainGames\Info\showRules;

const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';

function startBrainProgression(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_PROGRESSION_RULES);
    $isWonGame = true;

    for ($turn = 0; isGameGoingOn($turn, $isWonGame); $turn++) {
        $progressionLength = getRandomNumber(5, 10);
        $increment = getRandomNumber(2, 10);
        $excludedNumberIndex = getRandomNumber(0, $progressionLength - 1);
        $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
        $excludedNumber = getExcludedNumber($progression, $excludedNumberIndex, $increment);

        $isWonGame = startNextQuiz(
            forCreateQuestion: $progression,
            expectedAnswer: $excludedNumber
        );
    }

    showResult($isWonGame, $player);
}

function getProgression(int $progressionLength, int $excludeNumberIndex, int $increment): array
{
    $last = getRandomNumber(1, 20);
    $progression = [];

    for ($i = 0; $i < $progressionLength; $i++) {
        $last += $increment;

        if ($i === $excludeNumberIndex) {
            $progression[$i] = '..';
            continue;
        }

        $progression[$i] = (string)$last;
    }

    return $progression;
}

function getExcludedNumber(array $progression, int $excludedNumberIndex, int $increment): int
{
    $excludedNumber = 0;

    if ($excludedNumberIndex === 0) {
        $excludedNumber = (int)$progression[$excludedNumberIndex + 1] - $increment;
    } else {
        $excludedNumber = (int)$progression[$excludedNumberIndex - 1] + $increment;
    }

    return $excludedNumber;
}
