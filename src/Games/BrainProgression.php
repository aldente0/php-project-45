<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\getRandomNumber;

use const BrainGames\Engine\ROUND_COUNT;

function getBrainProgressionData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $progressionLength = getRandomNumber(5, 10);
        $increment = getRandomNumber(2, 10);
        $excludedNumberIndex = getRandomNumber(0, $progressionLength - 1);
        $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
        $excludedNumber = getExcludedNumber($progression, $excludedNumberIndex, $increment);

        $gameData[] = [$progression, $excludedNumber];
    }

    return $gameData;
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
