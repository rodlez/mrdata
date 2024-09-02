<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Rajoy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rajoy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo ('es el alcalde el que quiere que sean los vecinos el alcalde' . PHP_EOL);
    }
}
