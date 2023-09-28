<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\startNextQuiz;
use function cli\line;

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

function calcExpression(int $firstOperand, int $secondOperand, string $operation): int
{
    return match ($operation) {
        '+' => $firstOperand + $secondOperand,
        '-' => $firstOperand - $secondOperand,
        '*' => $firstOperand * $secondOperand,
        default => line('This operation is not processed'),
    };
}

function getRandomOperation(): string
{
    $operations = ['+', '-', '*'];
    $quantityOperations = count($operations);

    return $operations[rand(0, $quantityOperations - 1)];
}
