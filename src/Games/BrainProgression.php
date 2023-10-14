<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\welcomePlayer;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\getRoundCount;
use function BrainGames\Engine\play;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;

const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';

function startBrainProgression(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_PROGRESSION_RULES);

    $roundCount = getRoundCount(); 
    $gameData = getBrainProgressionData($roundCount);
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

function getBrainProgressionData(int $roundCount): array
{
    $gameData = [];

    for ($i = 0; $i < $roundCount; $i++) {
        $progressionLength = getRandomNumber(5, 10);
        $increment = getRandomNumber(2, 10);
        $excludedNumberIndex = getRandomNumber(0, $progressionLength - 1);
        $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
        $excludedNumber = getExcludedNumber($progression, $excludedNumberIndex, $increment);

        $gameData[] = [$progression, $excludedNumber];
    }

    return $gameData;
}
