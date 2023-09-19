<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function welcomePlayer()
{
    line('echo "Welcome to the Brain Games!\n";');
    $name = prompt('May I have your name?');
    line("Hello, %s", $name);
}
