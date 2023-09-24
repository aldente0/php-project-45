<?php

namespace BrainGames\Helpers\BrainEvenHelpers;

function isEven(int $number): bool
{
    return $number % 2 === 0 ? true : false;
}
