<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        //\App\Console\Commands\AddUsersCron::class,
        \App\Console\Commands\CrawlerCleanCron::class,
        \App\Console\Commands\CrawlerFirstTimeUpdateItemAndShopCron::class,
        \App\Console\Commands\CrawlerTaskCron::class
    ];

    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('command:add_users')->everyMinute();
        $schedule->command('command:crawler_first_time_update_item_and_shop')->everyMinute();
        $schedule->command('command:crawler_task')->everyMinute();
        $schedule->command('command:crawler_clean')->everyThirtyMinutes();
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
