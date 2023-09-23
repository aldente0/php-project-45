<?php

namespace BrainGames\Helpers\IsEvenGame;

use function cli\line;
use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\askQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}
