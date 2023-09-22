<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function askQuestion(int|string $string): void
{
    line("Question: {$string}");
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
