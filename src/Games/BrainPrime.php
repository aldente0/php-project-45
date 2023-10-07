<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\getBrainPrimeData;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\play;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;
use function BrainGames\Engine\welcomePlayer;

const BRAIN_PRIME_RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function startBrainPrime(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_PRIME_RULES);

    $gameData = getBrainPrimeData();
    $isWonGame = play($gameData);

    showResult($isWonGame, $player);
}

function isPrime(int $number): bool
{
    $isPrime = true;

    for ($i = 2; $isPrime && $i < $number; $i++) {
        if ($number % $i === 0) {
            $isPrime = false;
        }
    }

    return $isPrime;
}
