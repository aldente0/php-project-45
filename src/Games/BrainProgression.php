<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Helpers\BrainProgressionHelpers\getExcludedNumber;
use function BrainGames\Helpers\BrainProgressionHelpers\getProgression;

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
