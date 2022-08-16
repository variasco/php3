<?php

/** 
2. Реализовать паттерн Адаптер для связи внешней библиотеки (классы SquareAreaLib и
CircleAreaLib) вычисления площади квадрата (getSquareArea) и площади круга
(getCircleArea) с интерфейсами ISquare и ICircle имеющегося кода. Примеры классов даны
ниже. Причём во внешней библиотеке используются для расчётов формулы нахождения через
диагонали фигур, а в интерфейсах квадрата и круга — формулы, принимающие значения
одной стороны и длины окружности соответственно.
 */

interface asd
{
}

interface ISquare
{
    function squareArea(int $sideSquare);
}

interface ICircle
{
    function circleArea(int $circumference);
}



class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
    {
        $area = ($diagonal ** 2) / 2;
        return $area;
    }
}

class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
        $area = (M_PI * $diagonal ** 2) / 4;
        return $area;
    }
}

class SquareAreaAdapter implements ISquare
{
    protected $libSquareArea;

    function __construct(SquareAreaLib $libSquareArea)
    {
        $this->libSquareArea = $libSquareArea;
    }

    function squareArea(int $sideSquare)
    {
        $diagonal = sqrt(2 * ($sideSquare ** 2));
        return $this->libSquareArea->getSquareArea($diagonal);
    }
}

class CircleAreaAdapter implements ICircle
{
    protected $libCircleArea;

    function __construct(CircleAreaLib $libCircleArea)
    {
        $this->libCircleArea = $libCircleArea;
    }

    function circleArea(int $circumference)
    {
        $diagonal = $circumference / pi();
        return $this->libCircleArea->getCircleArea($diagonal);
    }
}

$squareArea = (new SquareAreaAdapter(new SquareAreaLib))->squareArea(5); // 25
$circleArea = (new CircleAreaAdapter(new CircleAreaLib))->circleArea(25); // ~50