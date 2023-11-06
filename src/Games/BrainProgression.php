<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\startGame;

const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';

function startApp(): void
{
    startGame(
        BRAIN_PROGRESSION_RULES,
        fn () => getProgressionAndExcludedNumber()
    );
}

function getProgressionAndExcludedNumber(): array
{
    $progressionLength = rand(5, 10);
    $increment = rand(2, 10);
    $last = rand(1, 20);
    $progression = [];

    for ($i = 0; $i < $progressionLength; $i++) {
        $progression[] = (string)($last + $increment * $i);
    }

    $excludedNumberIndex = rand(0, $progressionLength - 1);
    $excludedNumber = $progression[$excludedNumberIndex];

    $progression[$excludedNumberIndex] = '..';

    $progressionStr = implode(' ', $progression);

    return [$progressionStr, $excludedNumber];
}
