<?php

namespace BrainGames\Info;
use function cli\line;
use function cli\prompt;

const BRAIN_EVEN_RULES = 'Answer "yes" if the number is even, otherwise answer "no".';
const BRAIN_CALC_RULES = 'What is the result of the expression?';

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
        'brain-even' => line(BRAIN_EVEN_RULES),
        'brain-calc' => line(BRAIN_CALC_RULES),
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
