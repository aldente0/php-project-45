<?php

namespace BrainGames\Helpers\BrainProgressionHelpers;

use function BrainGames\Engine\getRandomNumber;

function getProgression(int $progressionLength, int $excludeNumberIndex, $increment): array
{
    $last = getRandomNumber(1, 20);
    $increment = getRandomNumber(1, 10);
    $progression[] = $last;

    for ($i = 1; $i < $progressionLength; $i++) {
        if ($i === $excludeNumberIndex) {
            $progression[] = '..';
            continue;
        }

        $last += $increment;
        $progression[] = (string)$last;
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
