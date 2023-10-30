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
    $progressionSkip = '..';
    $progressionLength = rand(5, 10);
    $increment = rand(2, 10);
    $excludedNumberIndex = rand(0, $progressionLength - 1);
    $last = rand(1, 20);
    $progression = [];

    for ($i = 0; $i < $progressionLength; $i++) {
        $last += $increment;

        if ($i === $excludedNumberIndex) {
            $progression[$i] = $progressionSkip;
        } else {
            $progression[$i] = (string)$last;
        }
    }

    $excludedNumber = $progression[array_search($progressionSkip, $progression) - 1] + $increment;

    return [$progression, $excludedNumber];
}
