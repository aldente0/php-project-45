<?php

namespace BrainGames\IsEvenGame;

use function cli\line;
use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\askQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;

function startIsEvenGame(): int
{
    $quantityCorrectAnswers = 0;
    $isCorrectAnswer = true;

    do {
        $number = getRandomNumber();
        askQuestion($number);
        $answer = answerTheQuestion();
        $expected = isEven($number) ? 'yes' : 'no';
        $isCorrectAnswer = checkAnswer($expected, $answer);

        if ($isCorrectAnswer) {
            $quantityCorrectAnswers++;
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expected);
        }
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
}

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}