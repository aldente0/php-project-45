<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const ROUND_COUNT = 3;

function startGame(string $gameRules, callable $getRoundData): void
{
    line("Welcome to the Brain Games!");
    $playerName = prompt('May I have your name?', '', "\n");
    line("Hello, %s", $playerName);
    line($gameRules);

    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $gameData[] = $getRoundData();
    }

    $isContinueGame = true;

    foreach ($gameData as [$forCreateQuestion, $expectedAnswer]) {
        $question = is_array($forCreateQuestion) ? implode(' ', $forCreateQuestion) : $forCreateQuestion;
        line("Question: {$question}");
        $answer = prompt('Your answer');
        $isContinueGame = $expectedAnswer == $answer ? true : false;
    
        if ($isContinueGame) {
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
            break;
        }
    }

    if ($isContinueGame) {
        line('Congratulations, %s!', $playerName);
    } else {
        line("Let's try again, %s!", $playerName);
    }
}
