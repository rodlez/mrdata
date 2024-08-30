<?php

declare(strict_types=1);

use Framework\Http;

/**
 * Show a given value with a nice format, give info to debug better
 */

function showNice(mixed $value, string $info = "")
{
    echo "*******************************************************************<br />";
    echo "<br />VALUE TYPE - " . gettype($value) . "<br />";
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    echo "*******************************************************************<br />";
    dd($info);
}
