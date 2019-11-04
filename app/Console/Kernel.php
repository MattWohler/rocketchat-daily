<?php

namespace App\Console;

use App\Console\Commands\SendGroupMessageCommand;
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
        SendGroupMessageCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->command(SendGroupMessageCommand::class, ['development', '--random'])
            ->weekdays()
            ->at('08:02');

        $schedule
            ->command(SendGroupMessageCommand::class, ['programmers', '--random'])
            ->weekdays()
            ->at('08:03');
    }
}
