<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\startGame;

const RULES = 'What is the result of the expression?';

function startApp(): void
{
    startGame(
        RULES,
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
