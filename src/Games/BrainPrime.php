<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Info\showResult;
use function BrainGames\Info\showRules;
use function BrainGames\Info\welcomePlayer;

const BRAIN_PRIME_RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function startBrainPrime(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_PRIME_RULES);
    $isWonGame = true;

    for ($turn = 0; isGameGoingOn($turn, $isWonGame); $turn++) {
        $number = getRandomNumber(2, 100);
        $isPrime = isPrime($number) ? 'yes' : 'no';

        $isWonGame = startNextQuiz(
            forCreateQuestion: $number,
            expectedAnswer: $isPrime
        );
    }

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
