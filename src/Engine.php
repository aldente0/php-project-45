<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Games\BrainCalc\getBrainCalcData;
use function BrainGames\Games\BrainProgression\getBrainProgressionData;
use function BrainGames\Games\BrainPrime\getBrainPrimeData;
use function BrainGames\Games\BrainGCD\getBrainGCDData;
use function BrainGames\Games\BrainEven\getBrainEvenData;

use const BrainGames\Games\BrainCalc\BRAIN_CALC;
use const BrainGames\Games\BrainProgression\BRAIN_PROGRESSION;
use const BrainGames\Games\BrainPrime\BRAIN_PRIME;
use const BrainGames\Games\BrainGCD\BRAIN_GCD;
use const BrainGames\Games\BrainEven\BRAIN_EVEN;

const BRAIN_CALC_RULES = 'What is the result of the expression?';
const BRAIN_PRIME_RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const BRAIN_GCD_RULES = 'Find the greatest common divisor of given numbers.';
const BRAIN_PROGRESSION_RULES = 'What number is missing in the progression?';
const BRAIN_EVEN_RULES = 'Answer "yes" if the number is even, otherwise answer "no".';

const ROUND_COUNT = 3;

function startGame(string $game): void
{
    $player = welcomePlayer();
    showRules($game);

    $gameData = getGameData($game);
    $isWonGame = play($gameData);

    showResult($isWonGame, $player);
}

function welcomePlayer(): string
{
    line("Welcome to the Brain Games!");
    $name = prompt('May I have your name?', '', "\n");
    line("Hello, %s", $name);

    return $name;
}

function showRules(string $game): void
{
    match ($game) {
        BRAIN_CALC => line(BRAIN_CALC_RULES),
        BRAIN_GCD => line(BRAIN_GCD_RULES),
        BRAIN_EVEN => line(BRAIN_EVEN_RULES),
        BRAIN_PRIME => line(BRAIN_PRIME_RULES),
        BRAIN_PROGRESSION => line(BRAIN_PROGRESSION_RULES),
        default => throw new \Exception('This operation is not processed')
    };
}

function getGameData(string $game): array
{
    $gameData = [];
    
    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $gameData[] = match ($game) {
            BRAIN_CALC => getBrainCalcData(),
            BRAIN_GCD => getBrainGCDData(),
            BRAIN_EVEN => getBrainEvenData(),
            BRAIN_PRIME => getBrainPrimeData(),
            BRAIN_PROGRESSION => getBrainProgressionData(),
            default => throw new \Exception('This operation is not processed')
        };
    }

    return $gameData;
    
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

function showResult(bool $isWonGame, string $player): void
{

    if ($isWonGame) {
        line('Congratulations, %s!', $player);
    } else {
        line("Let's try again, %s!", $player);
    }
}

function startNextRound(int|array $forCreateQuestion, int|string $expectedAnswer): bool
{
    $question = createQuestion($forCreateQuestion);
    line("Question: {$question}");
    $answer = prompt('Your answer');
    $isCorrectAnswer = $expectedAnswer == $answer ? true : false;

    if ($isCorrectAnswer) {
        line('Correct!');
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
    }

    return $isCorrectAnswer;
}

function createQuestion(int|array ...$args): string
{
    if (is_array($args[0])) {
        $args = [...$args[0]];
    }

    return implode(' ', $args);
}
