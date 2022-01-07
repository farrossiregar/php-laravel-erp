<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('general_notification')->dailyAt('07:00')->timezone('Asia/Jakarta');
        // $schedule->command('pm:syncron')->monthly()->timezone('Asia/Jakarta');
        $schedule->command('syncron-every-month')->monthlyOn(27, '09:00')->timezone('Asia/Jakarta');
        
        /**
         * notifikasi
         * 30 menit ke coordinator
         * 60 menit ke sm
         * 120 menit ke coordinator, sm dan osm
         */
        $schedule->command('wfm:notif')->everyMinute();
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
