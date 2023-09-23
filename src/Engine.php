<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function getRandomNumber(int $max = 0, int $min = 50): int
{
    return rand($min, $max);
}

function askQuestion(int|string $string): void
{
    line("Question: {$string}");
}

function createQuestion(...$args): string
{
    return implode(' ', $args);
}

function answerTheQuestion(): int|string
{
    return prompt('Your answer');
}

function isContinueGame(int $quantityCorrectAnswer, bool $isCorrectAnswer): bool
{
    return $quantityCorrectAnswer < 3 && $isCorrectAnswer;
}

function checkAnswer(string $expected, string $actual): bool
{
    return $expected === $actual ? true : false;
}
