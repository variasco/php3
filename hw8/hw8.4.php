<?php

function factorize(int $x): array
{
    $result = [];
    for ($i = 2; $i < sqrt($x); $i++) {
        while ($x % $i === 0) {
            $result[] = $i;
            $x /= $i;
        }
    }
    if ($x != 1) {
        $result[] = $x;
    }
    return $result;
}

$arrayOfPrimes = factorize(600851475143);
$maxPrime = $arrayOfPrimes[count($arrayOfPrimes) - 1];
echo $maxPrime;
