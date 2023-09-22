<?php

namespace BrainGames\Info;
use function cli\line;
use function cli\prompt;

function welcomePlayer(): string
{
    line("Welcome to the Brain Games!");
    $name = prompt('May I have your name?');
    line("Hello, %s", $name);

    return $name;
}

function showRules(string $gameName): void
{
    match ($gameName) {
        'brain-even' => line('Answer "yes" if the number is even, otherwise answer "no".'),
        'brain-calc' => line('What is the result of the expression?'),
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
