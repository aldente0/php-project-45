<?php

namespace BrainGames\Helpers\BrainProgressionHelpers;

use function BrainGames\Engine\getRandomNumber;

function getProgression(int $progressionLength, int $excludeNumberIndex, $increment): array
{
    $last = getRandomNumber(1, 20);

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
