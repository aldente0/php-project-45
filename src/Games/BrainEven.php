<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\startGame;

const RULES = 'Answer "yes" if the number is even, otherwise answer "no".';

function startApp(): void
{
    startGame(
        RULES,
        function () {
            $number = rand(0, 50);
            $isEven = $number % 2 === 0 ? 'yes' : 'no';

            return [$number, $isEven];
        }
    );
}
