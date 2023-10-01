<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isGameGoingOn;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Info\showResult;
use function BrainGames\Info\showRules;
use function BrainGames\Info\welcomePlayer;

const BRAIN_EVEN_RULES = 'Answer "yes" if the number is even, otherwise answer "no".';

function startBrainEven(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_EVEN_RULES);
    $isWonGame = true;

    for ($turn = 0; isGameGoingOn($turn, $isWonGame); $turn++) {
        $number = getRandomNumber();
        $isEven = isEven($number) ? 'yes' : 'no';

        $isWonGame = startNextQuiz(
            forCreateQuestion: $number,
            expectedAnswer: $isEven
        );
    }

    showResult($isWonGame, $player);
}

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}
