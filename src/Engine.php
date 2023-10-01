<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function getRandomNumber(int $max = 0, int $min = 50): int
{
    return rand($min, $max);
}

function printQuestion(int|string $string): void
{
    line("Question: {$string}");
}

function createQuestion(int|array ...$args): string
{
    if (is_array($args[0])) {
        $args = [...$args[0]];
    }

    return implode(' ', $args);
}

function answerTheQuestion(): string
{
    return prompt('Your answer');
}

function isGameGoingOn(int $turn, bool $isCorrectAnswer): bool
{
    return $turn < 3 && $isCorrectAnswer;
}

function checkAnswer(string|int $expected, string|int $actual): bool
{
    return $expected == $actual ? true : false;
}

function startNextQuiz(int|array $forCreateQuestion, int|string $expectedAnswer): bool
{
    $question = createQuestion($forCreateQuestion);
    printQuestion($question);
    $answer = answerTheQuestion();
    $isCorrectAnswer = checkAnswer($expectedAnswer, $answer);

    if ($isCorrectAnswer) {
        line('Correct!');
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
    }

    return $isCorrectAnswer;
}
