<?php

namespace BrainGames\Info;

use function cli\line;
use function cli\prompt;

const BRAIN_EVEN_RULES = 'Answer "yes" if the number is even, otherwise answer "no".';
const BRAIN_CALC_RULES = 'What is the result of the expression?';
const BRAIN_GSD_RULES = 'Find the greatest common divisor of given numbers.';
const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';
const BRAIN_PRIME_RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const UNKNOWN_GAME_RULES = 'There are no rules for this game.';

function welcomePlayer(): string
{
    line("Welcome to the Brain Games!");
    $name = prompt('May I have your name?', '', "\n");
    line("Hello, %s", $name);

    return $name;
}

function showRules(string $gameName): void
{
    match ($gameName) {
        'BrainEven' => line(BRAIN_EVEN_RULES),
        'BrainCalc' => line(BRAIN_CALC_RULES),
        'BrainGCD' => line(BRAIN_GSD_RULES),
        'BrainProgression' => line(BRAIN_PROGRESSION_RULES),
        'BrainPrime' => line(BRAIN_PRIME_RULES),
        default => line(UNKNOWN_GAME_RULES),
    };
}

function showResult(int $quantityCorrectAnswer, string $name): void
{
    if ($quantityCorrectAnswer === 3) {
        line('Congratulations, %s!', $name);
    } else {
        line("Let's try again, %s!", $name);
    }
}
