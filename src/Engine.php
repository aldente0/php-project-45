<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const ROUND_COUNT = 3;

function startGame(string $gameRules, callable $getRoundData): void
{
    $player = welcomePlayer();
    line($gameRules);

    $gameData = getGameData($getRoundData);
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

function getGameData(callable $getRoundData): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $gameData[] = $getRoundData();
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

function showResult(bool $isWonGame, string $player): void
{

    if ($isWonGame) {
        line('Congratulations, %s!', $player);
    } else {
        line("Let's try again, %s!", $player);
    }
}


function createQuestion(int|array ...$args): string
{
    if (is_array($args[0])) {
        $args = [...$args[0]];
    }

    return implode(' ', $args);
}
