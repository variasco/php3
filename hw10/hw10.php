<?php

// Идея реализации классического бинарного дерева была подчерпнута из github https://github.com/corpsee/data-structures/tree/master/src/Tree

class BinaryNode
{
    public $value;
    public $priority;
    public $left = NULL;
    public $right = NULL;

    public function __construct(int $value, int $priority)
    {
        $this->value = $value;
        $this->priority = $priority;
    }
}

class ArithmeticBinaryTree
{
    protected $root = NULL;
    protected $operations = ["+" => 3, "-" => 3, "*" => 2, "/" => 2];
    protected $indexes = [];
    protected $lexemes = [];

    public function isEmpty(): bool
    {
        return is_null($this->root);
    }

    public function dump(): void
    {
        print_r($this->root);
    }

    protected function insert($value, int $priority): void
    {
        $node = new BinaryNode($value, $priority);
        $this->insertNode($node, $this->root);
    }

    public function parse(string $str = "")
    {
        $str = str_replace(" ", "", mb_strtolower($str, 'UTF-8'));
        $start = -1;

        // Заполняем массив индексами операторов из исходной строки
        for ($i = 0; $i <= strlen($str); $i++) {
            if (array_key_exists($str[$i], $this->operations))
                $this->indexes[] = $i;
        }

        // Заполняем массив лексем, значениями и операторами
        for ($i = 0; $i < count($this->indexes); $i++) {
            $this->lexemes[] = substr($str, $start + 1, $this->indexes[$i] - $start - 1);
            $this->lexemes[] = $str[$this->indexes[$i]];
            $start = $this->indexes[$i];
        }

        // Если в конце строки был не оператор, то нужно добавить в массив лексем последнее значение
        if ($str[$start + 1])
            $this->lexemes[] = substr($str, $this->indexes[count($this->indexes) - 1] + 1);

        return $this->lexemes;

        // Заполняем дерево нашими лексемами
        // "5 + 6 * 7 / 13 - 94 * 3"
        $highestPriority = null;
        $operation = null;
        foreach ($this->lexemes as $value) {
            if (array_key_exists($value, $this->operations)) {
                $priority = array_search($value, $this->operations);
                if ($priority < $highestPriority) {
                    $highestPriority = $priority;
                    $operation = $value;
                }
            }
        }
        if (!is_null($operation)) {
            $this->insert($operation, $highestPriority);
        } else {
            $this->insert($value, 4);
        }
    }

    protected function insertNode(BinaryNode $node, BinaryNode &$parentNode): self
    {
        if (is_null($parentNode)) {
            $parentNode->$node;
        } else {
            if ($node->priority < $parentNode->priority) {
                $this->insertNode($node, $parentNode->left);
            } else {
                $this->insertNode($node, $parentNode->right);
            }
        }
        return $this;
    }
}

$arithmetic = new ArithmeticBinaryTree();
$lexemes = $arithmetic->parse("5 + 6 * 7 / 13 - 94");
print_r($lexemes);
/**
    "5 + 6 * 7 / 13 - 94 * 3"
    
 */
