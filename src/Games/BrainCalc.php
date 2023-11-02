<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\startGame;

const BRAIN_CALC_RULES = 'What is the result of the expression?';

function startBrainCalc(): void
{
    startGame(
        BRAIN_CALC_RULES,
        function () {
            $expression = getExpression();
            $result = calcExpression($expression);


            return [$expression, $result];
        }
    );
}

function getExpression(): string
{
    $firstOperand = rand(0, 50);
    $operation = getRandomOperation();
    $secondOperand = rand(0, 50);

    return implode(' ', [$firstOperand, $operation, $secondOperand]);
}

function calcExpression(string $expression): int
{
    [$firstOperand, $operation, $secondOperand] = explode(' ', $expression);

    return match ($operation) {
        '+' => (int)$firstOperand + (int)$secondOperand,
        '-' => (int)$firstOperand - (int)$secondOperand,
        '*' => (int)$firstOperand * (int)$secondOperand,
        default => throw new \Exception('This operation is not processed')
    };
}

function getRandomOperation(): string
{
    $operations = ['+', '-', '*'];
    $quantityOperations = count($operations);

    return $operations[rand(0, $quantityOperations - 1)];
}
