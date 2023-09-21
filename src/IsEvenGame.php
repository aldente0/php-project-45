<?php

namespace BrainGames\IsEvenGame;

use function BrainGames\WelcomePlayer\welcomePlayer;
use function cli\line;
use function cli\prompt;

function isEvenGame(): void
{
    $name = welcomePlayer();
    showRules();
    $quantityCorrectAnswer = play();
    showResult($quantityCorrectAnswer, $name);
}

function play(): int
{
    $quantityCorrectAnswer = 0;

    do {
        $number = getRandomNumber();
        line('Question: %d', $number);
        $answer = prompt('Your answer');
        $expected = isEven($number) ? 'yes' : 'no';
        $isCorrect = checkAnswer($expected, $answer);

        if ($isCorrect) {
            $quantityCorrectAnswer++;
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expected);
        }
    } while ($quantityCorrectAnswer < 3 && $isCorrect);

    return $quantityCorrectAnswer;
}

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}

function getRandomNumber(): int
{
    $min = 1;
    $max = 20;

    return rand($min, $max);
}

function checkAnswer(string $expected, string $actual): bool
{
    return $expected === $actual ? true : false;
}

function showRules(): void
{
    line('Answer "yes" if the number is even, otherwise answer "no".');
}

function showResult(int $quantityCorrectAnswer, $name): void
{
    if ($quantityCorrectAnswer === 3) {
        line('Congratulations, %s!', $name);
    } else {
        line("Let's try again, %s!", $name);
    }
}
