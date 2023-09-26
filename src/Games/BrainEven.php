<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Helpers\BrainEvenHelpers\isEven;

function startBrainEven(): int
{
    $quantityCorrectAnswers = 0;

    do {
        $number = getRandomNumber();
        $isEven = isEven($number) ? 'yes' : 'no';

        [$quantityCorrectAnswers, $isCorrectAnswer] = startNextQuiz(
            $quantityCorrectAnswers,
            forCreateAnswer: $number,
            expectedAnswer: $isEven
        );
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
}
