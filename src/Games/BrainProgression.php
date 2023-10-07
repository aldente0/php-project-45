<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\getBrainProgressionData;
use function BrainGames\Engine\welcomePlayer;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\play;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;

const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';

function startBrainProgression(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_PROGRESSION_RULES);

    $gameData = getBrainProgressionData();
    $isWonGame = play($gameData);

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
