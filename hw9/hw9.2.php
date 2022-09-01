<?php

include "services/binarySearch.php";
include "services/getRandArray.php";

$randArray = getRandArray(10000000);

function delete1(array &$array, int $value): void
{
    foreach ($array as $key => $val) {
        if ($val === $value) {
            unset($array[$key]);
        }
    }
}

function delete2(array &$array, int $value): void
{
    sort($array, SORT_NUMERIC);
    do {
        $index = binarySearch($array, $value);
        unset($array[$index]);
    } while ($index);
}

$startTime = new DateTime('now');
delete1($randArray, rand());
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "brute-force removal - " . $interval->format('%s.%F sec') . PHP_EOL;

$startTime = new DateTime('now');
delete2($randArray, rand());
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "binary search removal - " . $interval->format('%s.%F sec') . PHP_EOL;

/**
 * Если я нигде не ошибся, то выходит, что даже при массиве в 10'000'000 элементов перебор будет быстрее, чем бинарный поиск
    brute-force removal - 0.535571 sec
    binary search removal - 6.364040 sec
 */
