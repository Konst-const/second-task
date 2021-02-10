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
