<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\createQuestion;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\printQuestion;
use function BrainGames\Helpers\BrainEvenHelpers\isEven;
use function cli\line;

function startBrainEven(): int
{
    $quantityCorrectAnswers = 0;
    $isCorrectAnswer = true;

    do {
        $number = getRandomNumber();
        $expected = isEven($number) ? 'yes' : 'no';

        $question = createQuestion($number);
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