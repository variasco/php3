<?php

function heapify(&$arr, $countArr, $i)
{
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;
    if ($left < $countArr && $arr[$left] > $arr[$largest])
        $largest = $left;
    if ($right < $countArr && $arr[$right] > $arr[$largest])
        $largest = $right;
    if ($largest != $i) {
        $swap = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $swap;
        heapify($arr, $countArr, $largest);
    }
}
function heapSort(&$arr)
{
    $countArr = count($arr);
    for ($i = $countArr / 2 - 1; $i >= 0; $i--)
        heapify($arr, $countArr, $i);
    for ($i = $countArr - 1; $i >= 0; $i--) {
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;
        heapify($arr, $i, 0);
    }
}
