<?php

function convertString(string &$a, string $b): void
{
    $count = substr_count($a, $b);
    if ($count >= 2) {
        $a = explode($b, $a, 3);
        $a = implode(strrev($b), $a);
        $a = preg_replace("/" . strrev($b) . "/", $b, $a,1);
    }
}

//$a = ' hello Hello Dev Hello hello';
//convertString($a, 'Hello');
//var_dump($a);

function bubbleSort(array &$array, \Closure $compare)
{
    for ($i = 0; $i < count($array); $i++) {
        for ($y = ($i+1); $y < count($array); $y++) {
            if ($compare($array[$i], $array[$y], $i, $y)) {
                $c = $array[$i];
                $array[$i] = $array[$y];
                $array[$y] = $c;
            }
        }
    }
}

function mySortForKey(array $a, $b): array
{
    bubbleSort($a, function (array $one, array $two, $oneIndex, $twoIndex) use ($b) {
        if (! isset($one[$b])) {
            throw new Exception('Отсутствует ключ '. $b . ' в элементе под индексом: '. $oneIndex);
        }

        if (! isset($two[$b])) {
            throw new Exception('Отсутствует ключ '. $b . ' в элементе под индексом: '. $twoIndex);
        }

        return $one[$b] > $two[$b];
    });

    return $a;
}

$array = [
    [
        'a' => 1,
        'b' => 2,
    ],
    [
        'a' => 10,
        'b' => 3,
    ],
    [
        'a' => 3,
        'b' => 4,
    ],
    [
        'a' => 97,
        'b' => 0,
    ],
];

var_dump(mySortForKey($array, 'a'));
