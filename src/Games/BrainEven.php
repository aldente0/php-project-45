<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\startGame;

use const BrainGames\Engine\ROUND_COUNT;

const BRAIN_EVEN = 'brain-even';

function startBrainEven(): void
{
    startGame(BRAIN_EVEN);
}

function getBrainEvenData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $number = rand(0, 50);
        $isEven = isEven($number) ? 'yes' : 'no';

        $gameData[] = [$number, $isEven];
    }

    return $gameData;
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}
