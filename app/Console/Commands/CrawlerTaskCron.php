<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerShopJob;
use App\Jobs\CrawlerTaskJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrawlerTaskCron extends Command
{

    protected $signature = 'command:crawler_task';


    protected $description = 'Command crawler_first_time_update_shop';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerTaskJob())->onQueue('high'));
    }
}
