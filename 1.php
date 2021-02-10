<?php

function findSimple(int $a, int $b): array
{
    $arrN = [];

    for ($int = $a; $int <= $b; $int++) {
        if ($int == 1) {
            $arrN[] = $int;
            continue;
        }

        $isSimple = true;

        for ($d = 2; $d * $d <= $int; $d++) {
            if ($int % $d == 0) {
                $isSimple = false;
                break;
            }
        }

        if ($isSimple) {
            $arrN[] = $int;
        }
    }

    return $arrN;
}


//$arr = findSimple(1, 100);
//var_dump($arr);

function createTrapeze(array $a): array
{
    $keys = ['a', 'b', 'c'];

    return array_map(function (array $part) use ($keys) {
        return array_combine($keys, $part);
    }, array_chunk($a, 3));
}

//    $arr = createTrapeze([1, 2, 3, 4, 5, 6, 7, 8, 9]);
//    var_dump($arr);

function squareTrapeze(array &$a): void
{
    foreach ($a as &$arr) {
        $arr['s'] = 0.5 * $arr['c'] * ($arr['a'] + $arr['b']);
    }
}

$arr1 = createTrapeze([1, 2, 3, 4, 5, 6, 7, 8, 9]);
squareTrapeze($arr1);

//    var_dump($arr1);

function getSizeForLimit(array $a, int $b): array
{
    $maxS = $b;
    $aMaxS =[];
    foreach ($a as &$arr) {
        if ($arr['s'] >= $maxS) {
            $maxS = $arr['s'];
            $aMaxS = $arr;
        }
    }
    return $aMaxS;
}


$arr3 = getSizeForLimit($arr1, 12);

function getMin(array $a): int
{
    $maxNumber = max($a);
    foreach ($a as $b) {
        if ($b < $maxNumber) {
            $maxNumber = $b;
        }
    }
    return $maxNumber;
}

$minNumber = getMin([1, 2, -4, 0, 999, 321, 421, -2222, 123]);

function printTrapeze(array $a)
{
    echo '<table border="1">';
    echo '<tr><th>Сторона а</th><th>Сторона b</th><th>Высота с</th><th>Площадь S</th></tr>';
    foreach ($a as $arr) {
        if (fmod($arr['s'], 2) != 0) {
            echo '<tr style="background-color:darkred;">';
        } else {
            echo "</tr>";
        }
        echo '<td>' . $arr['a'] . '</td>' . '<td>' . $arr['b'] . '</td>' . '<td>' . $arr['c'] . '</td>' . '<td>' . $arr['s'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

//printTrapeze($arr2);

abstract class BaseMath
{
    protected function exp1(int $a, int $b, int $c)
    {
        return $a * (pow($b, $c));
    }
    protected function exp2(int $a, int $b, int $c)
    {
        return pow(($a / $b), $c);
    }

    abstract public function getValue();
}

class F1 extends BaseMath
{
    protected $a;
    protected $b;
    protected $c;

    public function __construct(int $a, int $b, int $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getValue()
    {
        return $this->exp1($this->a, $this->b, $this->c) + ($this->exp2($this->a, $this->b, $this->c)) %
            pow(3, min($this->a, $this->b, $this->c));
    }
}

$f1 = new F1(4, 5, 4);
echo $f1->getValue();
