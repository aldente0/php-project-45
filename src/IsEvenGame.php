<?php

namespace BrainGames\IsEvenGame;

use function BrainGames\WelcomePlayer\welcomePlayer;
use function cli\line;
use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\askQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\isContinueGame;

function isEvenGame(): int
{
    $quantityCorrectAnswer = 0;
    $isCorrectAnswer = true;

    do {
        $number = getRandomNumber();
        askQuestion($number);
        $answer = answerTheQuestion();
        $expected = isEven($number) ? 'yes' : 'no';
        $isCorrectAnswer = checkAnswer($expected, $answer);

        if ($isCorrectAnswer) {
            $quantityCorrectAnswer++;
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expected);
        }
    } while (isContinueGame($quantityCorrectAnswer, $isCorrectAnswer));

    return $quantityCorrectAnswer;
}

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}

function getRandomNumber(): int
{
    $min = 1;
    $max = 50;

    return rand($min, $max);
}

function showRules(string $gameName): void
{
    match ($gameName) {
        'brain-even' => line('Answer "yes" if the number is even, otherwise answer "no".'),
    };
}

function showResult(int $quantityCorrectAnswer, $name): void
{
    if ($quantityCorrectAnswer === 3) {
        line('Congratulations, %s!', $name);
    } else {
        line("Let's try again, %s!", $name);
    }
}
