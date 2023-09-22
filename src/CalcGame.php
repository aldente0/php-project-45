<?php

namespace BrainGames\CalcGame;
use function cli\line;
use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\askQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;

function calcExpression($firstOperand, $secondOperand, string $operation) {
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

function startCalcGame(): int
{
    $quantityCorrectAnswers = 0;
    $isCorrectAnswer = true;
    

    do {
        $firstOperand = getRandomNumber();
        $operation = getRandomOperation();

        if ($operation === '*') {
            $secondOperand = getRandomNumber(0, 10);
        } else {
            $secondOperand = getRandomNumber();
        }

        $expression = implode(" ", [$firstOperand, $operation, $secondOperand]);
        askQuestion($expression);
        $answer = answerTheQuestion();
        $expected = calcExpression($firstOperand, $secondOperand, $operation);
        $isCorrectAnswer = checkAnswer($expected, $answer);

        if ($isCorrectAnswer) {
            $quantityCorrectAnswers++;
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expected);
        }
    } while (isContinueGame($quantityCorrectAnswers, $isCorrectAnswer));

    return $quantityCorrectAnswers;
}