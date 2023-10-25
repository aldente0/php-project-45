<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\startGame;

const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';

function startBrainProgression(): void
{
    startGame(
        BRAIN_PROGRESSION_RULES,
        fn () => getProgressionAndExcludedNumber()
    );
}

function getProgressionAndExcludedNumber(): array
{
    $excludedNumber = 0;
    $progressionLength = rand(5, 10);
    $increment = rand(2, 10);
    $excludedNumberIndex = rand(0, $progressionLength - 1);
    $last = rand(1, 20);
    $progression = [];

    for ($i = 0; $i < $progressionLength; $i++) {
        $last += $increment;

        if ($i === $excludedNumberIndex) {
            $progression[$i] = '..';
            $excludedNumber = $last;
        } else {
            $progression[$i] = (string)$last;
        }
    }

    return [$progression, $excludedNumber];
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
