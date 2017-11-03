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
        \App\Console\Commands\TdoUserCmdCreate::class,
        \App\Console\Commands\MoveDayTable::class,
        \App\Console\Commands\MoveLessDateTable::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $date = date('Y-m-d', strtotime('-30 day'));
//            Artisan::queue('tdo:mdt', ['table' => 'tdo_order_datas', 'date' => $date, 'field' => 'created_at']);
            Artisan::queue('tdo:mdt', ['table' => 'tdo_order_datas', 'date' => $date, 'field' => 'created_at']);
        })->dailyAt('02:00');
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
