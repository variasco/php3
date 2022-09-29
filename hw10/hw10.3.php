<?php

class PolishNotation
{
    private $priorities = [   // таблица приоритетов операций
        "+" => 1,
        "-" => 1,
        "*" => 2,
        "/" => 2,
        "^" => 3
    ];

    public function compute(string $str)
    {
        $operations = [];   // стек для хранения операций
        $numbers = [];      // стек для хранения чисел
        $lexemes = $this->parse($str);
        foreach ($lexemes as $value) {

            // Если элемент - операция
            if (array_key_exists($value, $this->priorities)) {

                // Если стек операций пустой - вставляем значение
                if (is_null($this->top($operations))) {
                    $this->push($value, $operations);
                }

                // Если приоритет вставляемой операции ниже или равен, чем приоритет верхнего элемента - производим вычисление последней операции, затем вставляем значение
                elseif (
                    array_key_exists($this->top($operations), $this->priorities) &&
                    $this->priorities[$value] <= $this->priorities[$this->top($operations)]
                ) {
                    do {
                        $this->calculate($numbers, $operations);
                    } while ($this->priorities[$value] <= $this->priorities[$this->top($operations)]);
                    $this->push($value, $operations);
                } else {
                    $this->push($value, $operations);
                }
            }
            // Если элемент - открывающая скобка, просто добавляем её в стек операций
            elseif ($value == "(") {
                $this->push($value, $operations);
            }
            // Если элемент - закрывающая скобка, произовдим операции до того, пока не найдем открывающую скобку
            elseif ($value == ")") {
                do {
                    $this->calculate($numbers, $operations);
                } while ($this->top($operations) != "(");
                $this->pop($operations);
            } else {
                $this->push($value, $numbers);
            }
        }
        // Считаем всё что осталось в стеках
        while (!empty($operations)) {
            $this->calculate($numbers, $operations);
        }
        return $numbers[0];
    }

    public function parse($str): array
    {
        $str = str_replace(" ", "", mb_strtolower($str, 'UTF-8'));
        $operations = ["+", "-", "*", "/", "^", "(", ")"];
        $start = 0;
        $length = 0;
        $afterValue = false;
        for ($i = 0; $i < strlen($str); $i++) {
            if (in_array($str[$i], $operations)) {
                if ($afterValue) {
                    $lexemes[] = substr($str, $start, $length);
                    $afterValue = false;
                }
                $start = $i + 1;
                $length = 0;
                $lexemes[] = $str[$i];
            } else {
                $length++;
                $afterValue = true;
            }
        }
        if ($afterValue) {
            $lexemes[] = substr($str, $start, $length);
        }

        return $lexemes;
    }

    private function calculate(&$numbers, &$operations)
    {
        $y = $this->pop($numbers);
        $x = $this->pop($numbers);
        $operation = $this->pop($operations);
        $result = null;
        switch ($operation) {
            case '+':
                $result = $x + $y;
                break;
            case '-':
                $result = $x - $y;
                break;
            case '/':
                if ($y != 0)
                    $result = $x / $y;
                break;
            case '*':
                $result = $x * $y;
                break;
            case '^':
                $result = pow($x, $y);
                break;

            default:
                echo "something went wrong" . PHP_EOL;
                return null;
        }
        $this->push($result, $numbers);
    }

    private function push($value, array &$stack)
    {
        $stack[] = $value;
    }

    private function pop(array &$stack)
    {
        return array_pop($stack);
    }

    private function top(array $stack)
    {
        if (empty($stack)) {
            return null;
        }
        return $stack[count($stack) - 1];
    }
}

$polishNotation = new PolishNotation();
print_r($polishNotation->compute("(5 + 6) * 7 / 2 - 94"));
