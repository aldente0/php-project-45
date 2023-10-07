<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\getBrainCalcData;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\play;
use function BrainGames\Engine\showResult;
use function BrainGames\Engine\showRules;
use function BrainGames\Engine\welcomePlayer;
use function cli\line;

const BRAIN_CALC_RULES = 'What is the result of the expression?';

function startBrainCalc(): void
{
    $player = welcomePlayer();
    showRules(BRAIN_CALC_RULES);

    $gameData = getBrainCalcData();
    $isWonGame = play($gameData);

    showResult($isWonGame, $player);
}

function getExpression(): array
{
    $firstOperand = getRandomNumber();
    $operation = getRandomOperation();
    $secondOperand = getSecondOperand($operation);

    return [$firstOperand, $operation, $secondOperand];
}

function getSecondOperand(string $operation): int
{
    return $operation === '*' ? getRandomNumber(0, 10) : getRandomNumber();
}

function calcExpression(array $expression): int
{
    [$firstOperand, $operation, $secondOperand] = $expression;

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
