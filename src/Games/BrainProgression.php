<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\answerTheQuestion;
use function BrainGames\Engine\checkAnswer;
use function BrainGames\Engine\createQuestion;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isContinueGame;
use function BrainGames\Engine\printQuestion;
use function BrainGames\Helpers\BrainProgressionHelpers\getExcludedNumber;
use function BrainGames\Helpers\BrainProgressionHelpers\getProgression;
use function cli\line;

function startBrainProgression(): int
{
    $quantityCorrectAnswers = 0;
    $isCorrectAnswer = true;
    
    do {
        $progressionLength = getRandomNumber(5, 10);
        $increment = getRandomNumber(1, 10);
        $excludedNumberIndex = getRandomNumber(0, $progressionLength - 1);
        $progression = getProgression($progressionLength, $excludedNumberIndex, $increment);
        $expected = getExcludedNumber($progression, $excludedNumberIndex, $increment);

        $question = createQuestion($progression);
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