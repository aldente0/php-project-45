<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\startGame;
use const BrainGames\Engine\ROUND_COUNT;

const BRAIN_CALC = 'brain-calc';

function startBrainCalc(): void
{
    startGame(BRAIN_CALC);
}

function getBrainCalcData(): array
{
    $gameData = [];

    for ($i = 0; $i < ROUND_COUNT; $i++) {
        $expression = getExpression();
        $result = calcExpression($expression);

        $gameData[] = [$expression, $result];
    }

    return $gameData;
}

function getExpression(): array
{
    $firstOperand = getRandomNumber();
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
    return $operation === '*' ? getRandomNumber(0, 10) : getRandomNumber();
}

function getRandomOperation(): string
{
    $operations = ['+', '-', '*'];
    $quantityOperations = count($operations);

    return $operations[rand(0, $quantityOperations - 1)];
}
