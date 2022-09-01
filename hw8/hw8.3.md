### Определить сложность следующих алгоритмов. Сколько произойдет итераций?

1. ```
    $n = 100;
    $array[]= [];
    for ($i = 0; $i < $n; $i++) {            // 100 итераций
        for ($j = 1; $j < $n; $j *= 2) {     // 7 итераций, до n = 64
            $array[$i][$j]= true;
        }
    }
   ```

    > Сложность `O(n * log2(n))`, При n = 100, будет произведено 700 операций.

2. ```
    $n = 100;
    $array[] = [];
    for ($i = 0; $i < $n; $i += 2) {        // 50 итераций
        for ($j = $i; $j < $n; $j++) {      // 100 итараций
            $array[$i][$j]= true;
        }
    }
   ```

    > Сложность `O(n/2 * n) => O(1/2 * n^2) => O(n^2)`, При n = 100, будет произведено 5000 операций.