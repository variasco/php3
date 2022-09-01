<?php

function isPrime(int $n): bool
{
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

function findNthPrime(int $n)
{
    $primesCounter = 0;
    for ($i = 2; $i < pow($n, 2); $i++) {
        if (isPrime($i)) {
            $primesCounter++;
            if ($primesCounter === $n) {
                return $i;
            }
        }
    }
    return null;
}

echo findNthPrime(10001); // 104743
