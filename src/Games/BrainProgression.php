<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;

function startBrainProgression(): int
{
    $quantityCorrectAnswers = 0;
    $isCorrectAnswer = true;

    do {
        $progressionLength = getRandomNumber(5, 10);
        $increment = getRandomNumber(1, 10);
        $excludedNumberIndex = getRandomNumber(0, $progressionLength - 1);
        $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
        $excludedNumber = getExcludedNumber($progression, $excludedNumberIndex, $increment);

        [$quantityCorrectAnswers, $isCorrectAnswer] = startNextQuiz(
            $quantityCorrectAnswers,
            forCreateAnswer: $progression,
            expectedAnswer: $excludedNumber
        );
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
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
