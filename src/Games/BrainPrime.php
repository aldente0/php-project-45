<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;

function startBrainPrime(): int
{
    $quantityCorrectAnswers = 0;

    do {
        $number = getRandomNumber(2, 100);
        $isPrime = isPrime($number) ? 'yes' : 'no';

        [$quantityCorrectAnswers, $isCorrectAnswer] = startNextQuiz(
            $quantityCorrectAnswers,
            forCreateAnswer: $number,
            expectedAnswer: $isPrime
        );
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
}

function isPrime(int $number): bool
{
    $isPrime = true;

    for ($i = 2; $isPrime && $i < $number; $i++) {
        if ($number % $i === 0) {
            $isPrime = false;
        }
    }

    return $isPrime;
}
