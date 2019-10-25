<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendGroupMessageCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(
            SendGroupMessageCommand::class, [
                'development', 
                sprintf('--message=%s', collect(config('greetings'))->random())
            ])->weekdays()
              ->at('09:02');

        $schedule->command(
            SendGroupMessageCommand::class, [
                'programmers', 
                sprintf('--message=%s', collect(config('greetings'))->random())
            ])->weekdays()
              ->at('09:03');
    }
}
