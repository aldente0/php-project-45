<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\startGame;

use const BrainGames\Engine\ROUND_COUNT;

const BRAIN_PROGRESSION = 'brain-progression';

function startBrainProgression(): void
{
    startGame(BRAIN_PROGRESSION);
}

function getBrainProgressionData(): array
{
    $progressionLength = rand(5, 10);
    $increment = rand(2, 10);
    $excludedNumberIndex = rand(0, $progressionLength - 1);
    $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
    $excludedNumber = getExcludedNumber($progression, $excludedNumberIndex, $increment);

    return [$progression, $excludedNumber];
}

function getProgression(int $progressionLength, int $excludeNumberIndex, int $increment): array
{
    $last = rand(1, 20);
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
