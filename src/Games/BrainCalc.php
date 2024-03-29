<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\startGame;

const RULES = 'What is the result of the expression?';

function startApp(): void
{
    startGame(
        RULES,
        function () {
            $operations = ['+', '-', '*'];
            $quantityOperations = count($operations);

            $operation = $operations[rand(0, $quantityOperations - 1)];
            $firstOperand = rand(0, 50);
            $secondOperand = rand(0, 50);

            $expectedResult = match ($operation) {
                '+' => $firstOperand + $secondOperand,
                '-' => $firstOperand - $secondOperand,
                '*' => $firstOperand * $secondOperand
            };

            return [implode(' ', [$firstOperand, $operation, $secondOperand]), $expectedResult];
        }
    );
}
