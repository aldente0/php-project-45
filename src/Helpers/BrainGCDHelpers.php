<?php

namespace BrainGames\Helpers\BrainGCDHelpers;

function getGCD(int $num1, int $num2, int $minGCD): int
{
    $gcd = $minGCD;

    for ($i = getSmallerNumber($num1, $num2); $i > $gcd; $i--) {
        if (($num1 % $i == 0) && ($num2 % $i == 0)) {
            $gcd = $i;
        }
    }

    return $gcd;
}

function getSmallerNumber(int $num1, int $num2): int
{
    return ($num1 <= $num2) ? $num1 : $num2;
}
