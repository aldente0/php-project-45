<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\play;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;
use function BrainGames\Engine\welcomePlayer;

const BRAIN_EVEN_RULES = 'Answer "yes" if the number is even, otherwise answer "no".';

function startBrainEven(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_EVEN_RULES);

    $gameData = getBrainEvenData();
    $isWonGame = play($gameData);

    showResult($isWonGame, $player);
}

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}

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