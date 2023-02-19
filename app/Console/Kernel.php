<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 毎分
        $schedule->command('sample-command')->everyMinute()
            ->emailOutputTo('schedule@example.com');
        // 毎時
        $schedule->command('sample-command')->hourly();
        // 毎時8分
        $schedule->command('sample-command')->hourlyAt(8);
        // 毎日3:15（cron表記）
        $schedule->command('sample-command')->cron('15 3 * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
