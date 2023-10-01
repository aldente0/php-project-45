<?php

namespace BrainGames\Info;

use function cli\line;
use function cli\prompt;

function welcomePlayer(): string
{
    line("Welcome to the Brain Games!");
    $name = prompt('May I have your name?', '', "\n");
    line("Hello, %s", $name);

    return $name;
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
