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
        //上線時執行任務
        if (app()->environment('production')) {
            $schedule->command('backup:run')->cron('0 */4 * * *');
            $schedule->command('backup:monitor')->dailyAt('03:00');
            $schedule->command('backup:clean')->dailyAt('03:10');
        }

        //$schedule->command('command:add_users')->everyMinute();
        $schedule->command('command:crawler_first_time_update_item_and_shop')->everyMinute()->withoutOverlapping();
        $schedule->command('command:crawler_task')->everyMinute()->withoutOverlapping();
        $schedule->command('command:crawler_clean')->dailyAt(06);
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
