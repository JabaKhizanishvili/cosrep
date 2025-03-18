<?php

namespace App\Console;

use App\Console\Commands\TestCommand;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendFirstNotificationCommand;
use App\Console\Commands\SendPdfFIleToOrganizationCommand;
use App\Console\Commands\SendSecondNotificationCommand;
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
        // $schedule->command(SendFirstNotificationCommand::class)->everyTenMinutes()->withoutOverlapping();
//        $schedule->command(SendFirstNotificationCommand::class)->everyTenMinutes()->timezone('Asia/Tbilisi')->between('08:00', '23:00')->withoutOverlapping();
        $schedule->command(SendSecondNotificationCommand::class)->everyFiveMinutes()->timezone('Asia/Tbilisi')->withoutOverlapping();
        $schedule->command(SendPdfFIleToOrganizationCommand::class)->everyFifteenMinutes()->timezone('Asia/Tbilisi')->between('01:00', '07:00')->withoutOverlapping();
        // $schedule->command(TestCommand::class)->everyMinute()->withoutOverlapping();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
