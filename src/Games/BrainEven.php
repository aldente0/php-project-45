<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\startGame;

const BRAIN_EVEN = 'brain-even';

function startBrainEven(): void
{
    startGame(BRAIN_EVEN);
}

function getBrainEvenData(): array
{
    $number = rand(0, 50);
    $isEven = isEven($number) ? 'yes' : 'no';

    return [$number, $isEven];
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}
