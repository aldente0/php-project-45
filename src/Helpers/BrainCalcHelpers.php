<?php

namespace BrainGames\Helpers\BrainCalcHelpers;

function calcExpression(int $firstOperand, int $secondOperand, string $operation): int
{
    return match ($operation) {
        '+' => $firstOperand + $secondOperand,
        '-' => $firstOperand - $secondOperand,
        '*' => $firstOperand * $secondOperand,
    };
}

function getRandomOperation(): string
{
    $operations = ['+', '-', '*'];
    $quantityOperations = count($operations);

    return $operations[rand(0, $quantityOperations - 1)];
}