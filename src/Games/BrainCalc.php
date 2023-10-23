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

function getExpression(): array
{
    $firstOperand = rand(0, 50);
    $operation = getRandomOperation();
    $secondOperand = getSecondOperand($operation);

    return [$firstOperand, $operation, $secondOperand];
}

function calcExpression(array $expression): int
{
    [$firstOperand, $operation, $secondOperand] = $expression;

    return match ($operation) {
        '+' => $firstOperand + $secondOperand,
        '-' => $firstOperand - $secondOperand,
        '*' => $firstOperand * $secondOperand,
        default => throw new \Exception('This operation is not processed')
    };
}

function getSecondOperand(string $operation): int
{
    return $operation === '*' ? rand(0, 10) : rand(0, 50);
}

function getRandomOperation(): string
{
    $operations = ['+', '-', '*'];
    $quantityOperations = count($operations);

    return $operations[rand(0, $quantityOperations - 1)];
}
