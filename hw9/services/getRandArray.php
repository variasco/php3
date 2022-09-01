<?php

function getRandArray($count, $min = 0, $max = 100000)
{
    $array = [];
    for ($i = 0; $i < $count; $i++) {
        $array[] = rand($min, $max);
    }
    return $array;
}
