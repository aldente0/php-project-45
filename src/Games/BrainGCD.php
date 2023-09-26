<?php

namespace BrainGames\Games\BrainGCD;

use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\createQuestion;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\printQuestion;
use function BrainGames\Helpers\BrainGCDHelpers\getGCD;
use function cli\line;

function startBrainGCD(): int
{
    $quantityCorrectAnswers = 0;
    $isCorrectAnswer = true;

    do {
        $multiplier = getRandomNumber(2, 5);
        $firstNumber = getRandomNumber(1, 50) * $multiplier;
        $secondNumber = getRandomNumber(1, 50) * $multiplier;
        $expected = getGCD($firstNumber, $secondNumber, $multiplier);
        
        $question = createQuestion($firstNumber, $secondNumber);
        printQuestion($question);
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
