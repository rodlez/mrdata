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

/**
 * Interval between today and other date string in format 'Y-m-d' e.g (2020-12-25)
 */

function datesInterval(string $date): DateInterval
{

    $today = date_create(date('Y-m-d'));
    $date = date_create($date);

    return date_diff($today, $date);
}
