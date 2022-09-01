<?php

include "services/getRandArray.php";
include "services/bubbleSort.php";
include "services/shakerSort.php";
include "services/quickSort.php";
include "services/heapSort.php";

$arrayLength = 1000000;

$startTime = new DateTime('now');
$randArray = getRandArray($arrayLength);
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "create array of " . $arrayLength . " elements - " . $interval->format('%s.%F sec') . PHP_EOL;

$startTime = new DateTime('now');
bubbleSort($randArray);
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "bubbleSort - " . $interval->format('%s.%F sec') . PHP_EOL;

$startTime = new DateTime('now');
shakerSort($randArray);
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "shakerSort - " . $interval->format('%s.%F sec') . PHP_EOL;

$startTime = new DateTime('now');
quickSort($randArray);
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "quickSort - " . $interval->format('%s.%F sec') . PHP_EOL;

$startTime = new DateTime('now');
heapSort($randArray);
$endTime = new DateTime('now');
$interval = $startTime->diff($endTime);
echo "heapSort - " . $interval->format('%s.%F sec') . PHP_EOL;

/**
 * Вывод при массиве в 10'000 элементов
    create array of 10000 elements - 0.001060 sec
    bubbleSort - 7.387446 sec
    shakerSort - 4.778808 sec
    quickSort - 0.006477 sec
    heapSort - 0.095781 sec
 */

/**
 * Вывод при массиве в 1'000'000 элементов. Пузырьковая и шейкерная сортировки убраны, так как слишком медленные
    create array of 1000000 elements - 0.121475 sec
    quickSort - 2.371833 sec
    heapSort - 10.085493 sec
 */
