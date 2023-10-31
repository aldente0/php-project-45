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

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        [$question, $expectedAnswer] = $getRoundData();
        line("Question: {$question}");
        $answer = prompt('Your answer');

        if ((string)$expectedAnswer !== $answer) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
            line("Let's try again, %s!", $playerName);
            return;
        }

        line('Correct!');
    }

    line('Congratulations, %s!', $playerName);
}
