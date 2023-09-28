<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;

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

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}
