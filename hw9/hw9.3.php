<?php

include "services/getRandArray.php";

function linearSearch($myArray, $num)
{
    $counter = 0;
    $length = count($myArray);
    for ($i = 0; $i < $length; $i++) {
        $counter++;
        if ($myArray[$i] == $num) {
            echo "linearSearch counter - " . $counter . PHP_EOL;
            return $i;
        } elseif ($myArray[$i] > $num) {
            echo "linearSearch counter - " . $counter . PHP_EOL;
            return null;
        }
    }
    echo "linearSearch counter - " . $counter . PHP_EOL;
    return null;
}

function binarySearch($myArray, $num)
{
    $counter = 0;
    $left = 0;
    $right = count($myArray) - 1;
    while ($left <= $right) {
        $counter++;
        $middle = floor(($right + $left) / 2);
        if ($myArray[$middle] == $num) {
            echo "binarySearch counter - " . $counter . PHP_EOL;
            return $middle;
        } elseif ($myArray[$middle] > $num) {
            $right = $middle - 1;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }
    echo "binarySearch counter - " . $counter . PHP_EOL;
    return null;
}

function interpolationSearch($myArray, $num)
{
    $counter = 0;
    $start = 0;
    $last = count($myArray) - 1;
    while (($start <= $last) && ($num >= $myArray[$start]) && ($num <= $myArray[$last])) {
        $counter++;
        $pos = floor($start + ((($last - $start) / ($myArray[$last] - $myArray[$start])) * ($num - $myArray[$start])));
        if ($myArray[$pos] == $num) {
            echo "interpolationSearch counter - " . $counter . PHP_EOL;
            return $pos;
        }
        if ($myArray[$pos] < $num) {
            $start = $pos + 1;
        } else {
            $last = $pos - 1;
        }
    }
    echo "interpolationSearch counter - " . $counter . PHP_EOL;
    return null;
}

$randArray = getRandArray(100000, 0, 100);
sort($randArray);

echo "linearSearch - " . linearSearch($randArray, rand(0, 100)) . PHP_EOL;
echo "binarySearch - " . binarySearch($randArray, rand(0, 100)) . PHP_EOL;
echo "interpolationSearch - " . interpolationSearch($randArray, rand(0, 100)) . PHP_EOL;

/**
 * Вывод:
    linearSearch counter - 35762
    linearSearch - 35761
    binarySearch counter - 7
    binarySearch - 13280
    interpolationSearch counter - 1
    interpolationSearch - 40999
 */
