<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\startGame;

const BRAIN_EVEN_RULES = 'Answer "yes" if the number is even, otherwise answer "no".';

function startBrainEven(): void
{
    startGame(
        BRAIN_EVEN_RULES,
        function () {
            $number = rand(0, 50);
            $isEven = isEven($number) ? 'yes' : 'no';
    
            return [$number, $isEven];
        }
    );
}
function isEven(int $number): bool
{
    return $number % 2 === 0;
}
