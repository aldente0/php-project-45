<?php

namespace BrainGames\Engine;

const BRAIN_CALC_FUNCTION = 'BrainGames\Games\BrainCalc\startBrainCalc';
const BRAIN_EVEN_FUNCTION = 'BrainGames\Games\BrainEven\startBrainEven';
const BRAIN_GCD_FUNCTION = 'BrainGames\Games\BrainGCD\startBrainGCD';
const BRAIN_PRIME_FUNCTION = 'BrainGames\Games\BrainPrime\startBrainPrime';
const BRAIN_PROGRESSION_FUNCTION = 'BrainGames\Games\BrainProgression\startBrainProgression';
const UNKNOWN_GAME = 'Unknown game!!!';

use function BrainGames\Info\showResult;
use function BrainGames\Info\showRules;
use function BrainGames\Info\welcomePlayer;
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

function isContinueGame(int $quantityCorrectAnswers, bool $isCorrectAnswer): bool
{
    return $quantityCorrectAnswers < 3 && $isCorrectAnswer;
}

function checkAnswer(string|int $expected, string|int $actual): bool
{
    return $expected == $actual ? true : false;
}

function startApp(string $gameName): void
{
    $name = welcomePlayer();
    showRules($gameName);
    $gameFunction = getGameFunction($gameName);

    if (! function_exists($gameFunction)) {
        line('unknown game!!!');
        return;
    }

    $quantityCorrectAnswers = $gameFunction();
    showResult($quantityCorrectAnswers, $name);
}

function getGameFunction(string $gameName): string
{
    return match ($gameName) {
        'BrainEven' => BRAIN_EVEN_FUNCTION,
        'BrainPrime' => BRAIN_PRIME_FUNCTION,
        'BrainCalc' => BRAIN_CALC_FUNCTION,
        'BrainProgression' => BRAIN_PROGRESSION_FUNCTION,
        'BrainGCD' => BRAIN_GCD_FUNCTION,
        default => UNKNOWN_GAME
    };
}

function startNextQuiz(int $quantityCorrectAnswers, int|array $forCreateAnswer, int|string $expectedAnswer): array
{
    $question = createQuestion($forCreateAnswer);
    printQuestion($question);
    $answer = answerTheQuestion();
    $isCorrectAnswer = checkAnswer($expectedAnswer, $answer);

    if ($isCorrectAnswer) {
        $quantityCorrectAnswers++;
        line('Correct!');
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
    }

    return [$quantityCorrectAnswers, $isCorrectAnswer];
}
