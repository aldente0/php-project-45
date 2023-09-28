<?php

namespace BrainGames\Helpers\BrainCalcHelpers;

use function cli\line;

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
