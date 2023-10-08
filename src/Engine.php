<?php

namespace BrainGames\Engine;

use function BrainGames\Games\BrainCalc\getExpression;
use function BrainGames\Games\BrainCalc\calcExpression;
use function BrainGames\Games\BrainEven\isEven;
use function BrainGames\Games\BrainPrime\isPrime;
use function BrainGames\Games\BrainGCD\getGCD;
use function BrainGames\Games\BrainProgression\getProgression;
use function BrainGames\Games\BrainProgression\getExcludedNumber;
use function cli\line;
use function cli\prompt;

const ROUND_COUNT = 3;

function welcomePlayer(): string
{
    line("Welcome to the Brain Games!");
    $name = prompt('May I have your name?', '', "\n");
    line("Hello, %s", $name);

    return $name;
}

function play(array $gameData): bool
{
    $isWonGame = true;

    foreach ($gameData as [$forCreateQuestion, $expectedAnswer]) {
        $isWonGame = startNextRound($forCreateQuestion, $expectedAnswer);

        if (! $isWonGame) {
            return $isWonGame;
        }
    }

    return $isWonGame;
}

function getBrainCalcData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $expression = getExpression();
        $result = calcExpression($expression);

        $gameData[] = [$expression, $result];
    }

    return $gameData;
}

function getBrainGCDData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $multiplier = getRandomNumber(2, 5);
        $firstNumber = getRandomNumber(1, 50) * $multiplier;
        $secondNumber = getRandomNumber(1, 50) * $multiplier;
        $numbers = [$secondNumber, $firstNumber];
        $gcd = getGCD($firstNumber, $secondNumber, $multiplier);

        $gameData[] = [$numbers, $gcd];
    }

    return $gameData;
}

function getBrainPrimeData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $number = getRandomNumber(2);
        $isPrime = isPrime($number) ? 'yes' : 'no';

        $gameData[] = [$number, $isPrime];
    }

    return $gameData;
}

function getBrainProgressionData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $progressionLength = getRandomNumber(5, 10);
        $increment = getRandomNumber(2, 10);
        $excludedNumberIndex = getRandomNumber(0, $progressionLength - 1);
        $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
        $excludedNumber = getExcludedNumber($progression, $excludedNumberIndex, $increment);

        $gameData[] = [$progression, $excludedNumber];
    }

    return $gameData;
}

function getBrainEvenData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $number = getRandomNumber();
        $isEven = isEven($number) ? 'yes' : 'no';

        $gameData[] = [$number, $isEven];
    }

    return $gameData;
}

function showRules(string $rules): void
{
    line($rules);
}

function showResult(bool $isWonGame, string $player): void
{
    if ($isWonGame) {
        line('Congratulations, %s!', $player);
    } else {
        line("Let's try again, %s!", $player);
    }
}

function getRandomNumber(int $min = 0, int $max = 50): int
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
    return $turn < ROUND_COUNT && $isCorrectAnswer;
}

function checkAnswer(string|int $expected, string|int $actual): bool
{
    return $expected == $actual ? true : false;
}

function startNextRound(int|array $forCreateQuestion, int|string $expectedAnswer): bool
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
