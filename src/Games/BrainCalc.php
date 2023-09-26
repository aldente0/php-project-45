<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;
use function BrainGames\Helpers\BrainCalcHelpers\calcExpression;
use function BrainGames\Helpers\BrainCalcHelpers\getRandomOperation;

function startBrainCalc(): int
{
    $quantityCorrectAnswers = 0;

    do {
        $firstOperand = getRandomNumber();
        $operation = getRandomOperation();

        if ($operation === '*') {
            $secondOperand = getRandomNumber(0, 10);
        } else {
            $secondOperand = getRandomNumber();
        }

        $expression = [$firstOperand, $operation, $secondOperand];
        $result = calcExpression($firstOperand, $secondOperand, $operation);

        [$quantityCorrectAnswers, $isCorrectAnswer] = startNextQuiz(
            $quantityCorrectAnswers,
            forCreateAnswer: $expression,
            expectedAnswer: $result
        );
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
}
