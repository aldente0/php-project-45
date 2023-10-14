<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\getRoundCount;
use function BrainGames\Engine\play;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;
use function BrainGames\Engine\welcomePlayer;

const BRAIN_PRIME_RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function startBrainPrime(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_PRIME_RULES);

    $roundCount = getRoundCount();
    $gameData = getBrainPrimeData($roundCount);
    $isWonGame = play($gameData);

    showResult($isWonGame, $player);
}

function isPrime(int $number): bool
{
    $isPrime = true;

    $numberHalf = ceil($number / 2);

    for ($i = 2; $isPrime && $i < $numberHalf; $i++) {
        if ($number % $i === 0) {
            $isPrime = false;
        }
    }

    return $isPrime;
}

function getBrainPrimeData(int $roundCount): array
{
    $gameData = [];

    for ($i = 0; $i < $roundCount; $i++) {
        $number = getRandomNumber(2);
        $isPrime = isPrime($number) ? 'yes' : 'no';

        $gameData[] = [$number, $isPrime];
    }

    return $gameData;
}
