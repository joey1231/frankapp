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
        \App\Console\Commands\SyncOffer::class,
        \App\Console\Commands\WadogoCommand::class,
        \App\Console\Commands\OneapiCommand::class,
        \App\Console\Commands\AdxCommand::class,
        \App\Console\Commands\CpiCommand::class,
        \App\Console\Commands\CrunchCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('syncoffer')
                  ->hourly();
        $schedule->command('wadogo')
                  ->hourly();
        $schedule->command('oneapi')
                  ->hourly();

         $schedule->command('adx')
                  ->hourly();
        $schedule->command('crunch')
                  ->hourly();
        $schedule->command('cpi')
                  ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
