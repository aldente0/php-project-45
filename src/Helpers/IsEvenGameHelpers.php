<?php

namespace BrainGames\Helpers\IsEvenGame;

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}
