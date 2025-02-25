<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\SendPreventiviCron::class,
        //Commands\SendTestCron::class

   ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //$schedule->command('app:send-preventivi')everyTenMinutes();
        ### TEST ##
        $schedule->command('app:send-preventivi')->emailOutputTo(env('MAIL_MARCELLO'));
        //$schedule->command('sendtestcron:cron')->emailOutputTo(env('MAIL_MARCELLO'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
