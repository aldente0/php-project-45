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

    foreach ($getRoundData() as [$question, $expectedAnswer]) {
        line("Question: {$question}");
        $answer = prompt('Your answer');

        if (! $expectedAnswer == $answer) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
            line("Let's try again, %s!", $playerName);
            return;
        }

        line('Correct!');
    }

    line('Congratulations, %s!', $playerName);
}
