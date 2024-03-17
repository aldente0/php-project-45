<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\startGame;

const RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function startApp(): void
{
    startGame(
        RULES,
        function () {
            $number = rand(1, 50);
            $expectedAnswer = isPrime($number) ? 'yes' : 'no';

            return [$number, $expectedAnswer];
        }
    );
}

function isPrime(int $number): bool
{
    $isPrime = true;
    if ($number === 1) {
        return false;
    }

    $numberHalf = ceil($number / 2);

    for ($i = 2; $i <= $numberHalf; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}
