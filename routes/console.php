<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Console\Commands\NotifyUsers;
use App\Console\Commands\Rajoy;

use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// test schedule command
//Schedule::command('rajoy')->everyTenSeconds()->appendOutputTo('marianadas.txt');

Schedule::command('notify-users')->everyMinute();
