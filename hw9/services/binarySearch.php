<?php

function binarySearch($myArray, $num)
{
    $left = 0;
    $right = count($myArray) - 1;
    while ($left <= $right) {
        $middle = floor(($right + $left) / 2);
        if ($myArray[$middle] == $num) {
            return $middle;
        } elseif ($myArray[$middle] > $num) {
            $right = $middle - 1;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }
    return null;
}
