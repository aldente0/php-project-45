<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\createQuestion;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\printQuestion;
use function BrainGames\Helpers\BrainCalcHelpers\calcExpression;
use function BrainGames\Helpers\BrainCalcHelpers\getRandomOperation;
use function cli\line;

function startBrainCalc(): int
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

        $expected = calcExpression($firstOperand, $secondOperand, $operation);

        $expression = createQuestion($firstOperand, $operation, $secondOperand);
        printQuestion($expression);
        $answer = answerTheQuestion();
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