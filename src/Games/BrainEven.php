<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\getRandomNumber;

use const BrainGames\Engine\ROUND_COUNT;

function getBrainEvenData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $number = getRandomNumber();
        $isEven = isEven($number) ? 'yes' : 'no';

        $gameData[] = [$number, $isEven];
    }

    return $gameData;
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}
