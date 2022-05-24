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
        Commands\LowStockDailyMail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:promocodeDelete')->everyFifteenMinutes();
        $schedule->command('command:discountDelete')->everyFifteenMinutes();
        $schedule->command('command:orderpaycancel')->everyMinute();
        $schedule->command('command:lowstockdaily')->daily()->at('23:55');
        $schedule->command('command:discountAdd')->everyFifteenMinutes();
        $schedule->command('command:promocodeAdd')->everyFifteenMinutes();
        $schedule->command('command:newsletteremail')->everyFifteenMinutes();
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
